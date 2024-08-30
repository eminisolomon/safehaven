# Account Management

## Create Account

Create a new main account.

```php
$accountType = "Savings";
$username = "johntimothy";
$additionalDetails = ["verified" => true, "notes" => ""];

SafeHaven::account()->createAccount($accountType, $username, $additionalDetails);
```

## Create Sub Account

Establish a new sub-account under a main account.

```php
$name = "Solomon";
$lastName = "Doe";
$phone = "070350123456";
$email = "solomon.doe@live.com";
$externalReference = "Solomon-Ref";
$identityType = "BVN";
$identityNumber = "22123456708";
$identityId = "identityId123456";
$otp = "123456";
$isVerified = false;
$subAccountDetails = [];
$subAccountAdditionalDetails = [
    "verified" => true,
    "notes" => "Sub-account for Solomon"
];
$callbackUrl = "https://yourcallbackurl.com/handle-callback";

SafeHaven::account()->createSubAccount(
    $name,
    $lastName,
    $phone,
    $email,
    $externalReference,
    $identityType,
    $identityNumber,
    $identityId,
    $otp,
    $isVerified,
    $subAccountDetails,
    $subAccountAdditionalDetails,
    $callbackUrl
);
```

## Update Sub Account

Update existing sub-account information.

```php
$subAccountId = "659fed3a48143e0024db7e90";
$newName = "John Timothy";
$newUsername = "johntimothy";
$newPhone = "070350123456";
$newEmail = "johntimothy@live.com";
$newAccountUsername = "johntimothy";
$newAccountNumber = "22123456708";
$newIsVerified = false;
$newSubAccountDetails = [];
$newSubAccountAdditionalDetails = ["verified" => true, "notes" => ""];


SafeHaven::account()->updateSubAccountById($subAccountId, $newName, $newUsername, $newPhone, $newEmail, $newAccountUsername, $newAccountNumber, $newIsVerified, $newSubAccountDetails, $newSubAccountAdditionalDetails);

$externalReference = "johntimothy";
SafeHaven::account()->updateSubAccountByReference($externalReference, $newName, $newUsername, $newPhone, $newEmail, $newAccountUsername, $newAccountNumber, $newIsVerified, $newSubAccountDetails, $newSubAccountAdditionalDetails);
```

## Fetch Accounts

Retrieve a list of accounts (main or sub-accounts).

```php
$pageNumber = 0;
$pageSize = 10;
$isSubAccount = true;

SafeHaven::account()->getAccounts($pageNumber, $pageSize, $isSubAccount);
```

## Fetch Single Account

Get details of a specific account using its ID.

```php
$accountId = "659ea57c48143e0024db3eb0";

SafeHaven::account()->getAccount($accountId);
```

## Update Account Preferences

Modify notification preferences for an account.

```php
$accountId = "id:659ea57c48143e0024db3eb0";
$notificationSettings = [
    "smsNotification" => true,
    "emailNotification" => true,
    "emailMonthlyStatement" => true,
    "smsMonthlyStatement" => true
];

SafeHaven::account()->updateAccountPreferences($accountId, $notificationSettings);
```

## Account Statement

Retrieve an account statement for a specified period.

```php
$accountID = "659ea57c48143e0024db3eb0";
$fromDate = "";  // Specify date in 'YYYY-MM-DD' format or leave empty
$toDate = "";    // Specify date in 'YYYY-MM-DD' format or leave empty
$type = "debit"; // Options: 'debit', 'credit', or ''
$page = 0;
$limit = 100;

SafeHaven::account()->getAccountStatement($accountID, $fromDate, $toDate, $type, $page, $limit);
```

For more details, please refer to the [Safe Haven's API accounts set of endpoints and required parameters](https://safehavenmfb.readme.io/reference/accounts)
