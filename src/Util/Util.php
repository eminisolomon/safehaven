<?php

namespace Eminisolomon\SafeHaven\Util;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Psr\Http\Message\ResponseInterface;

abstract class Util
{
    public static function convertToObject(ResponseInterface $response): array
    {
        $body = json_decode((string) $response->getBody(), true);

        if (! is_array($body)) {
            throw SafeHavenException::responseBodyNotAnArray();
        }

        $mapped = [];
        foreach ($body as $key => $value) {
            $mapped[$key] = $value;
        }

        return $mapped;
    }
}
