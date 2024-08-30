<?php

use Eminisolomon\SafeHaven\SafeHaven;

// BVN verification
$number = "2239500008";
$phoneNumber = "090366042221";
$otp = "123456";
$oneTimePassword = "123456";
$debitAccountNumber = "0122297393";

SafeHaven::verification()->confirmBankVerificationNumber(
    $number,
    $phoneNumber,
    $otp,
    $oneTimePassword,
    $debitAccountNumber
);

// Identity check Verify BVN, NIN, CAC, and credit
$type = "NIN";
$number = "28123456792";
$provider = "firstCentral";
$debitAccountNumber = "0001297393";

SafeHaven::verification()->initiateVerification(
    $type,
    $number,
    $debitAccountNumber,
    null, // No OTP needed for NIN in this example
    null, // No verifier ID needed
    $provider,
    true // Async is true by default
);

// Send one-time password for BVN verification
$number = "09036604991";

SafeHaven::verification()->dispatchOtpToNumber($number);

// Verify Identification by validating the OTP for BVN or NIN verification
$identityId = "identity_id_example"; // Replace with the actual identity ID from your initial request
$type = "BVN"; // Or "NIN" depending on your use case
$otp = "654321"; // The OTP sent to the customer’s phone number

SafeHaven::verification()->verifyIdentification(
    $identityId,
    $type,
    $otp
);
