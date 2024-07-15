<?php

namespace Eminisolomon\SafeHaven\Exceptions;

use Exception;

class SafeHavenException extends Exception
{
    public static function ClientIDRequired(): self
    {
        return new self("SafeHaven OAuth Client ID key not set.");
    }

    public static function apiRequestFail($error): self
    {
        $errorMessage = 'API request failed: ' . json_encode($error);
        return new self($errorMessage);
    }


    public static function invalidArgument(): self
    {
        return new self("The resource ID cannot be null or whitespace.");
    }


    public static function responseBodyNotAnArray(): self
    {
        return new self("Response body is not an array.");
    }


    public static function methodDoesntExist($name): self
    {
        return new self("Method {$name} does not exist.");
    }
}
