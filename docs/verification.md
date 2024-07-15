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
$type = "NIN"; // Type of verification
$number = "28123123456"; // Identification number
$provider = "firstCentral"; // Provider
$debitAccountNumber = "0001297393"; // Account number

SafeHaven::verification()->validateIdentity($type, $number, $debitAccountNumber, $provider);
```

## Send OTP for BVN Verification
Dispatch a one-time password to a mobile number for BVN verification.
```php
$number = "09036604991"; // Mobile number

SafeHaven::verification()->dispatchOtpToNumber($number);
```

For additional information and detailed usage instructions, please refer to the [Safe Haven's API Verify BVN](https://safehavenmfb.readme.io/reference/post_identity-1) and [Safe Haven's Verify NIN, CAC, and credit check](https://safehavenmfb.readme.io/reference/post_identity).
