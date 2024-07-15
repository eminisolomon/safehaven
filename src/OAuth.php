<?php

namespace Eminisolomon\SafeHaven;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

abstract class OAuth
{

    protected string $algorithm = 'RS256';
    protected  string $environment;
    protected string $client_id = '';


    /**
     * @throws SafeHavenException
     */
    public function __construct()
    {
        $this->setEnvironment()
            ->setClientID();
    }

    public function setEnvironment(): static
    {
        $this->environment = SafeHaven::config('environment') === 'production'
            ? SafeHaven::config('production_endpoint')
            : SafeHaven::config('sandbox_endpoint');

        return $this;
    }


    public function setClientID(): static
    {
        if (empty(SafeHaven::config('client_id'))) {
            throw SafeHavenException::ClientIDRequired();
        }
        $this->client_id = SafeHaven::config('client_id');

        return $this;
    }
    public function payload(): array
    {
        return [
            "iss" => SafeHaven::config('company_domain'),
            "sub" => $this->client_id,
            "aud" => $this->environment,
            "iat" => Carbon::now()->timestamp,
            "exp" => Carbon::now()->addHour()->timestamp,
        ];
    }
    public function generateClientAssertion(): string
    {
        return Cache::remember($this->cachePrefix() . 'client_assertion', $this->getCacheDuration(), function () {
            return JWT::encode(
                $this->payload(),
                SafeHaven::config('keys.private'),
                $this->algorithm
            );
        });
    }

    public function token()
    {
        return Cache::remember($this->cachePrefix() . 'safehaven_access_token', $this->getCacheTokenDuration(), function () {
            try {
                $response = $this->requestToken();
                $tokenData = Util::convertToObject($response);
                $this->cacheTokenData($tokenData);
                return $tokenData;
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }

    /**
     * @throws SafeHavenException
     */
    private function requestToken(): Response
    {
        $requestor = new ApiRequestor;
        return $requestor->request('POST', 'oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'client_id' => $this->client_id,
            'client_assertion' => $this->generateClientAssertion()
        ], false);
    }
    private function cacheTokenData($tokenData): void
    {
        $expiresIn = $tokenData['expires_in'];
        Cache::put($this->cachePrefix() . 'safehaven_access_token_duration', $expiresIn, now()->addSeconds($expiresIn));
    }

    protected function getCacheTokenDuration()
    {
        return Cache::get(
            $this->cachePrefix() . 'safehaven_access_token_duration',
            $this->getCacheDuration()
        );
    }


    public function cachePrefix(): string
    {
        return 'safehaven::';
    }
    protected function getCacheDuration(): int
    {
        return 30 * 60;
    }
}
