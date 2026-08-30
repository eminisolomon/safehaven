<?php

namespace Eminisolomon\SafeHaven;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;
use Exception;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;

abstract class OAuth
{
    private static array $cache = [];

    protected string $algorithm = 'RS256';

    protected string $environment;

    protected string $client_id = '';

    protected Configuration $configuration;

    /**
     * @throws SafeHavenException
     */
    public function __construct(?Configuration $configuration = null)
    {
        $this->configuration = $configuration ?? Configuration::fromRuntime();
        $this->setEnvironment()
            ->setClientID();
    }

    public function setEnvironment(): static
    {
        $this->environment = $this->configuration->get('environment') === 'production'
            ? $this->configuration->get('production_endpoint')
            : $this->configuration->get('sandbox_endpoint');

        return $this;
    }

    public function setClientID(): static
    {
        if (empty($this->configuration->get('client_id'))) {
            throw SafeHavenException::ClientIDRequired();
        }
        $this->client_id = $this->configuration->get('client_id');

        return $this;
    }

    public function payload(): array
    {
        return [
            'iss' => $this->configuration->get('company_domain'),
            'sub' => $this->client_id,
            'aud' => $this->environment,
            'iat' => time(),
            'exp' => time() + 3600,
        ];
    }

    public function generateClientAssertion(): string
    {
        return self::$cache[$this->cachePrefix().'client_assertion'] ??= (function () {
            return JWT::encode(
                $this->payload(),
                $this->configuration->get('keys.private'),
                $this->algorithm,
            );
        })();
    }

    public function token()
    {
        return self::$cache[$this->cachePrefix().'safehaven_access_token'] ??= (function () {
            try {
                $response = $this->requestToken();
                $tokenData = Util::convertToObject($response);
                $this->cacheTokenData($tokenData);

                return $tokenData;
            } catch (Exception $e) {
                throw $e;
            }
        })();
    }

    /**
     * @throws SafeHavenException
     */
    private function requestToken(): ResponseInterface
    {
        $requestor = new ApiRequestor($this->configuration);

        return $requestor->request('POST', 'oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'client_id' => $this->client_id,
            'client_assertion' => $this->generateClientAssertion(),
        ], false);
    }

    private function cacheTokenData($tokenData): void
    {
        $expiresIn = $tokenData['expires_in'];
        self::$cache[$this->cachePrefix().'safehaven_access_token_duration'] = $expiresIn;
    }

    protected function getCacheTokenDuration()
    {
        return self::$cache[$this->cachePrefix().'safehaven_access_token_duration'] ?? $this->getCacheDuration();
    }

    public function cachePrefix(): string
    {
        return 'safehaven::'.hash('sha256', $this->client_id).'::';
    }

    protected function getCacheDuration(): int
    {
        return 30 * 60;
    }
}
