<?php

use Eminisolomon\SafeHaven\SafeHaven;

// Get banks supported for USSD payments
SafeHaven::ussd()->getBanks();

// Create a USSD payment reference
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
