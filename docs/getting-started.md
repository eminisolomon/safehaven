# Getting started

### Base Installation

SafeHaven Laravel can be installed via Composer:

```bash
composer require eminisolomon/safehaven
```

Publishing the config file

```bash
php artisan vendor:publish --provider="Eminisolomon\SafeHaven\SafeHavenServiceProvider" --tag="config"
```

This is the default content of the config file:

```php

use Eminisolomon\SafeHaven\Client;
use Eminisolomon\SafeHaven\Service\AccountService;
use Eminisolomon\SafeHaven\Service\BeneficiaryService;
use Eminisolomon\SafeHaven\Service\BillingService;
use Eminisolomon\SafeHaven\Service\CheckoutService;
use Eminisolomon\SafeHaven\Service\TransferService;
use Eminisolomon\SafeHaven\Service\VerificationService;
use Eminisolomon\SafeHaven\Service\VirtualAccountService;

return [
    'environment' => 'sandbox', //sandbox || production
    'company_domain' => 'https://solomonolatunji.dev',
    'client_id' => env('SAFE_HAVEN_CLIENT_ID', ''),
    'sandbox_endpoint' => 'https://api.sandbox.safehavenmfb.com',
    'production_endpoint' => 'https://api.safehavenmfb.com',
    'alg' => 'RS256',
    'typ' => 'JWT',


    'services' => [
        'client' => Client::class,
        'account' => AccountService::class,
        'virtual' => VirtualAccountService::class,
        'billing' => BillingService::class,
        'beneficiary' => BeneficiaryService::class,
        'transfer' => TransferService::class,
        'verification' => VerificationService::class,
        'checkout' => CheckoutService::class,
    ],


    'keys' => [

        'private' =>'<<<EOD
        //your private key here
EOD',

        'public' => '<<<EOD
        //your public key here
EOD',


    ]
];
```

### Generating SafeHaven API Credentials

To utilize SafeHaven services in your Laravel application, secure API credentials are required. Here’s how to set them up:

1. Visit the [SafeHaven App Creation Guide](https://safehavenmfb.readme.io/reference/creating-an-app).
2. Follow the step-by-step process to register a new application.
3. Upon registration, a pair of public and private keys will be generated for you.
4. Insert these keys into the `safehaven.php` file within your Laravel config directory.

For comprehensive instructions on API key generation, consult the [official SafeHaven documentation](https://safehavenmfb.readme.io/reference/creating-an-app).

Publishing the views file is optional:

```bash
php artisan vendor:publish --provider="Eminisolomon\SafeHaven\SafeHavenServiceProvider" --tag="views"
```
