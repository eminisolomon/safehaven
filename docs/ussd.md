# USSD Payments

## Get USSD Banks

Retrieve the banks supported for USSD payments.

```php
SafeHaven::ussd()->getBanks();
```

## Create USSD Payment Reference

Create a payment reference and USSD string for a merchant payment.

```php
SafeHaven::ussd()->createReference(
    2500,
    "Test Merchant",
    "901",
    "https://yourcallbackurl.com/handle-callback",
    [
        "bankCode" => "090286",
        "accountNumber" => "0112345678",
    ]
);
```

See the [Safe Haven USSD API reference](https://safehavenmfb.readme.io/reference/create-reference) for request requirements.
