<?php

namespace Eminisolomon\SafeHaven;


use Eminisolomon\SafeHaven\Service\AbstractService;

class Client extends AbstractService
{
    /**
     * Get webhook payload
     *
     * @param bool $decodeJson      Set true to decode the JSON
     * @param bool $decodeAsArray   Set true to decode the JSON as array
     * @return mixed
     */
    public static function getWebhookPayload(bool $decodeJson = true, bool $decodeAsArray = true): mixed {
        $input = file_get_contents('php://input');
        if (!$decodeJson) {
            return $input;
        }
        return json_decode($input, $decodeAsArray);
    }
}