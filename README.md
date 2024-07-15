# Safe Haven MFB Laravel package

[![Latest Version](https://img.shields.io/github/release/eminisolomon/safehaven.svg?style=flat-square)](https://github.com/eminisolomon/safehaven/releases)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/eminisolomon/safehaven.svg?style=flat-square)](https://packagist.org/packages/eminisolomon/safehaven)
[![Total Downloads](https://img.shields.io/packagist/dt/eminisolomon/safehaven.svg?style=flat-square)](https://packagist.org/packages/eminisolomon/safehaven)

Safe Haven MFB for your Laravel project made easy

## Installation

You can install the package via composer:

```bash
composer require eminisolomon/safehaven
```

Publishing the config file

```bash
php artisan vendor:publish --provider="Eminisolomon\SafeHaven\SafeHavenServiceProvider" --tag="config"
```

## Usage

```php

use Eminisolomon\SafeHaven\SafeHaven;

//Create Account
$accountType = "Savings";
$accountName = "Solomon Olatunji";
SafeHaven::account()->createAccount($accountType, $accountName, [
    "verified" => true,
    "notes" => ""
]);

```

For more information, please refer to the [package documentation](docs/index.md).

## Automatic API Token Refresh

For seamless and uninterrupted access to API endpoints, it's recommended to integrate an automated mechanism in your Laravel application. This mechanism will be responsible for generating client assertions and subsequently exchanging them for API tokens. By doing so, the API token gets refreshed automatically before it reaches its expiration, ensuring your API interactions remain consistent and uninterrupted. To implement this, simply add the provided script to your Laravel application's cron job configuration

**Step 1**: Import `ApiRequestor` from `Eminisolomon\SafeHaven`.

```php
use Eminisolomon\SafeHaven\ApiRequestor;
```

**Step 2**: Update `schedule` in `app/Console/Kernel.php` to refresh the token every 30 minutes.

```php
protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        (new ApiRequestor())->token();
    })->everyThirtyMinutes();
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security-related issues, please email realsolomon@outlook.com instead of using the issue tracker.

## Credits

- [Solomon Olatunji](https://github.com/eminisolomon)
- [All Contributors](CONTRIBUTORS.md)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
