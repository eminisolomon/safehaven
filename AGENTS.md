# SafeHaven PHP SDK

SafeHaven has a framework-neutral core and an optional Laravel integration.
Keep HTTP, authentication, configuration, and services in `src/` free of
Laravel dependencies. Laravel-only Facade, provider, Blade, controller, and
event code belongs in the Laravel adapter.

## Validation

- `composer check` runs validation, configuration, Pint, PHPStan, and Pest.
- `composer test` runs the Unit and Feature suites.
- `composer lint:check` verifies formatting.
- `composer analyse` runs PHPStan.
- `composer build` builds the Testbench Workbench.
- `composer serve` starts the Workbench application.

When changing an endpoint, update the service, add a Unit test for its route
and payload, update documentation, and update examples when the public API
changes. Never commit credentials, private keys, or access tokens.
