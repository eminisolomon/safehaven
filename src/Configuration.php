<?php

namespace Eminisolomon\SafeHaven;

class Configuration
{
    public function __construct(private readonly array $values) {}

    public function get(string $key, mixed $default = null): mixed
    {
        $value = $this->values;

        foreach (explode('.', $key) as $segment) {
            if (! is_array($value) || ! array_key_exists($segment, $value)) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }

    public static function fromEnvironment(): self
    {
        return new self([
            'environment' => getenv('SAFE_HAVEN_ENVIRONMENT') ?: 'sandbox',
            'company_domain' => getenv('SAFE_HAVEN_COMPANY_DOMAIN') ?: '',
            'client_id' => getenv('SAFE_HAVEN_CLIENT_ID') ?: '',
            'sandbox_endpoint' => getenv('SAFE_HAVEN_SANDBOX_ENDPOINT') ?: 'https://api.sandbox.safehavenmfb.com',
            'production_endpoint' => getenv('SAFE_HAVEN_PRODUCTION_ENDPOINT') ?: 'https://api.safehavenmfb.com',
            'keys' => ['private' => getenv('SAFE_HAVEN_PRIVATE_KEY') ?: ''],
        ]);
    }

    public static function fromRuntime(): self
    {
        if (\function_exists('config')) {
            $values = \config('safehaven', []);

            if (is_array($values)) {
                return new self($values);
            }
        }

        return self::fromEnvironment();
    }
}
