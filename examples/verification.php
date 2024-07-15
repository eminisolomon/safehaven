<?php
use MaylancerDev\SafeHaven\SafeHaven;


//BVN verification
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


// Identity check Verify NIN, CAC, and credit
$type = "NIN";
$number = "28123456792";
$provider = "firstCentral";
$debitAccountNumber = "0001297393";

SafeHaven::verification()->validateIdentity(
    $type,
    $number,
    $debitAccountNumber,
    $provider
);


// Send one-time password for BVN verification
$number = "09036604991";
SafeHaven::verification()->dispatchOtpToNumber($number);





