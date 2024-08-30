# Bank Transfer Management

## Get List of Banks

Retrieve all available banks.

```php
SafeHaven::transfer()->getBanks();
```

## Verify Bank Account

Verify a bank account by providing the bank code and account number.

```php
$accountNumber = "0106296301"; // Example account number
$bankCode = "999240";          // Bank code (use '999240' for Sandbox)

SafeHaven::transfer()->verifyBank($bankCode, $accountNumber);
```

## Initiate a Bank Transfer

Perform a bank transfer using the provided details.

```php
$nameEnquiryReference = "999240240115121423216610677133";
$debitAccountNumber = "0111297393";
$beneficiaryBankCode = "999240";
$beneficiaryAccountNumber = "0106296301";
$amount = "200";
$saveBeneficiary = true;

SafeHaven::transfer()->initiateTransfer($nameEnquiryReference, $debitAccountNumber, $beneficiaryBankCode, $beneficiaryAccountNumber, $amount, $saveBeneficiary);
```

## Get Transaction Status

Check the status of a transfer using the session ID.

```php
$sessionId = "999240240115123132300429164435";
SafeHaven::transfer()->getTransferStatus($sessionId);
```

## Get Account Transactions

Retrieve transactions for a specific account.

```php
$accountId = "659d4c6c6aeb250024bcc592";
SafeHaven::transfer()->getTransfers($accountId);
```

---

For more information, please refer to the [Safe Haven's API Transfers](https://safehavenmfb.readme.io/reference/transfers).
