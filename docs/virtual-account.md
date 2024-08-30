# Virtual Account Management

## Create a Virtual Account

Generate a new virtual account with specified parameters.

```php
$accountName = "John Timothy";
$validFor = 900; // Duration the account is valid for in seconds
$amountControl = 'Fixed'; // Type of amount control
$bankCode = '999240'; // Your bank code
$accountNumber = '0106296301'; // Account number
$amount = 500; // Initial amount

SafeHaven::virtual()->createAccount(
    $accountName,
    $validFor,
    $amountControl,
    $bankCode,
    $accountNumber,
    $amount
);
```

## Retrieve a Virtual Account by ID

Fetch details of a specific virtual account using its unique ID.

```php
$accountId = "65ae3938c88b2b0024e4dbaa";
SafeHaven::virtual()->getAccount($accountId);
```

## Update a Virtual Account by ID

Modify the details of an existing virtual account.

```php
$accountId = "65ae3e40c88b2b0024e4e1c7";
SafeHaven::virtual()->updateAccount($accountId);
```

## Delete a Virtual Account

Remove a virtual account from the system using its ID.

```php
$accountId = "65ae3938c88b2b0024e4dbaa";
SafeHaven::virtual()->deleteAccount($accountId);
```

For more information, please refer to the [Safe Haven's API Virtual Account](https://safehavenmfb.readme.io/reference/virtual-accounts).
