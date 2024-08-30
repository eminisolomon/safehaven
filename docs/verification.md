# Verification Management

## BVN (Bank Verification Number) Confirmation

Confirm a user's BVN details.

```php
$number = "2239500008";
$phoneNumber = "090366042221";
$otp = "123456";
$oneTimePassword = "123456";
$debitAccountNumber = "0122297393";

SafeHaven::verification()->confirmBankVerificationNumber($number, $phoneNumber, $otp, $oneTimePassword, $debitAccountNumber);
```

## Identity Verification

Verify different types of identities like NIN, CAC, etc.

```php
$type = "NIN"; // Type of verification (e.g., BVN, NIN, CREDITCHECK)
$number = "28123456792"; // Identification number
$debitAccountNumber = "0001297393"; // Account number to debit
$provider = "firstCentral"; // Provider for CREDITCHECK (optional)
$async = true; // Asynchronous request flag (default is true)

SafeHaven::verification()->initiateVerification(
    $type,
    $number,
    $debitAccountNumber,
    null, // OTP, if applicable
    null, // Verifier ID, if applicable
    $provider,
    $async
);
```

## Verify Identification

Validate the OTP for BVN or NIN verification.

```php
$identityId = "identity_id_example"; // Replace with the actual identity ID from your initial request
$type = "BVN"; // Type of verification (e.g., BVN, NIN)
$otp = "654321"; // The OTP sent to the customer’s phone number

SafeHaven::verification()->verifyIdentification(
    $identityId,
    $type,
    $otp
);
```

## Send OTP for BVN Verification

Dispatch a one-time password to a mobile number for BVN verification.

```php
$number = "09036604991"; // Mobile number

SafeHaven::verification()->dispatchOtpToNumber($number);
```

For additional information and detailed usage instructions, please refer to the [Safe Haven's API Verify BVN](https://safehavenmfb.readme.io/reference/post_identity-1) and [Safe Haven's Verify NIN, CAC, and credit check](https://safehavenmfb.readme.io/reference/post_identity).
