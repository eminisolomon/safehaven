<?php

namespace Eminisolomon\SafeHaven;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class ApiRequestor extends OAuth
{
    private Client $http;

    public function __construct(?Configuration $configuration = null, ?Client $http = null)
    {
        parent::__construct($configuration);
        $this->http = $http ?? new Client;
    }

    public function request(string $method, string $uri, array $payload = [], $includeAuth = true): ResponseInterface
    {
        $response = $this->_requestRaw($includeAuth, $method, $uri, $payload);

        if ($response->getStatusCode() >= 400) {
            $error = $this->serializeErrorResponse($response);

            throw SafeHavenException::apiRequestFail($error);
        }

        return $response;
    }

    /**
     * @return mixed
     */
    public function _requestRaw(mixed $includeAuth, string $method, string $uri, array $payload): ResponseInterface
    {
        $headers = $this->_customHeaders($includeAuth);

        return $this->http->request($method, rtrim($this->environment, '/').'/'.ltrim($uri, '/'), [
            'headers' => array_merge($headers, ['Accept' => 'application/json']),
            'json' => $payload,
            'http_errors' => false,
        ]);
    }

    public function _customHeaders(mixed $includeAuth): array
    {
        if (! $includeAuth) {
            return [];
        }

        $tokenData = $this->token();

        return [
            'ClientID' => $tokenData['ibs_client_id'],
            'authorization' => 'Bearer '.$tokenData['access_token'],
        ];
    }

    public function serializeErrorResponse(mixed $response): array
    {
        $body = json_decode((string) $response->getBody(), true) ?: [];

        return [
            'status' => $response->getStatusCode(),
            'message' => $body['message'] ?? 'Safe Haven API request failed',
        ];
    }
}
