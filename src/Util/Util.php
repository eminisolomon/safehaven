<?php

namespace MaylancerDev\SafeHaven\Util;

use Exception;
use MaylancerDev\SafeHaven\Exceptions\SafeHavenException;

abstract class Util
{
   public static function convertToObject($response): array
   {
        $body = json_decode($response->getBody()->getContents(), true);

        if (!is_array($body)) {
            throw SafeHavenException::responseBodyNotAnArray();
        }

        $mapped = [];
        foreach ($body as $key => $value) {
            $mapped[$key] = $value;
        }

        return $mapped;
    }
}
