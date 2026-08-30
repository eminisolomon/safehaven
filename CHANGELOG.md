# Changelog

All notable changes to `safehaven` will be documented in this file

## [Unreleased]

### Added

- Added a framework-neutral `SafeHavenClient` for vanilla PHP and non-Laravel frameworks.
- Added virtual-account transfer status and transaction lookup methods.
- Added corporate sub-account creation support.
- Added `UssdPaymentService` with USSD bank listing and payment-reference creation.
- Added facade PHPDoc annotations for IDE support of dynamic `SafeHaven::service()` methods.
- Added PHPUnit/Pest configuration with Unit and Feature test suites.
- Added endpoint and package integration tests.
- Added USSD documentation and updated API examples.

### Fixed

- Corrected data-bundle purchases to use the `vas/pay/data` endpoint.
- Corrected and completed billing, account, and virtual-account examples and documentation.

### Changed

- Replaced Laravel HTTP, Cache, Config, and Carbon usage in the SDK core with Guzzle, injectable configuration, and PSR responses.
- Laravel-specific Facade and service-provider integrations remain available as an adapter.
- Constrained `firebase/php-jwt` to the supported `^6.11` range.
- Added Pest’s Laravel plugin and Mockery as development dependencies.
- Refreshed the Composer lock file and compatible Laravel testing dependencies.

## 1.0.0 - 201X-XX-XX

- initial release
