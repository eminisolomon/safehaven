<?php

use Eminisolomon\SafeHaven\SafeHaven;


//Create a virtual account
$accountName = "John timothy";
$validFor = 900;
$amountControl = 'Fixed';
$bankCode = '999240';
$accountNumber = '0106296301';
$amount = 500;

SafeHaven::virtual()->createAccount(
    $accountName,
    $validFor,
    $amountControl,
    $bankCode,
    $accountNumber,
    $amount
);



//Get a virtual account by ID
$accountId = "65ae3938c88b2b0024e4dbaa";
SafeHaven::virtual()->getAccount($accountId);


//Update virtual account by ID
$accountId = "65ae3e40c88b2b0024e4e1c7";
SafeHaven::virtual()->updateAccount($accountId);



//Delete a virtual account using the account ID
$accountId = "65ae3938c88b2b0024e4dbaa";
SafeHaven::virtual()->deleteAccount($accountId);
