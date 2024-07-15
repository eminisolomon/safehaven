<?php

namespace Eminisolomon\SafeHaven;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;

class ApiRequestor extends OAuth
{


    public function request(string $method, string $uri, array $payload = [], $includeAuth = true): Response
    {
        $response = $this->_requestRaw($includeAuth, $method, $uri, $payload);
        if ($response->failed()) {
            $error = $this->serializeErrorResponse($response);
            throw SafeHavenException::apiRequestFail($error);
        }

        return $response;
    }


    /**
     * @param mixed $includeAuth
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @return mixed
     */
    public function _requestRaw(mixed $includeAuth, string $method, string $uri, array $payload): mixed
    {
        $headers = $this->_customHeaders($includeAuth);

        return Http::withHeaders($headers)
            ->accept('application/json')
            ->contentType('application/json')
            ->$method($this->environment . '/' . $uri, $payload);
    }


    /**
     * @param mixed $includeAuth
     * @return array
     */
    public function _customHeaders(mixed $includeAuth): array
    {
        if (!$includeAuth) {
           return [];
        }

        $tokenData = $this->token();

        return [
            'ClientID' => $tokenData['ibs_client_id'],
            'authorization' => 'Bearer ' . $tokenData['access_token']
        ];
    }

    /**
     * @param mixed $response
     * @return array
     */
    public function serializeErrorResponse(mixed $response): array
    {
        return [
            'status' => $response['statusCode'],
            'message' => $response['message'],
        ];
    }
}