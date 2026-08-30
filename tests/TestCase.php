<?php

namespace Eminisolomon\SafeHaven\Tests;

use Eminisolomon\SafeHaven\SafeHavenServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [SafeHavenServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        \config([
            'safehaven.client_id' => 'test-client-id',
            'safehaven.company_domain' => 'https://example.test',
            'safehaven.sandbox_endpoint' => 'https://api.sandbox.safehavenmfb.com',
            'safehaven.production_endpoint' => 'https://api.safehavenmfb.com',
        ]);
    }
}
