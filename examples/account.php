<?php

use Eminisolomon\SafeHaven\SafeHaven;



//Create Account
SafeHaven::account()->createAccount("Savings", "SolomonDev", [
    "verified" => true,
    "notes" => ""
]);

//Create Sub Account
SafeHaven::account()->createSubAccount(
    "Tolulope",
    "SolomonDev",
    "07035014587",
    "SolomonDev@live.com",
    "SolomonDev",
    "22395929708",
    false,
    [],
    [
        "verified" => true,
        "notes" => ""
    ],
    ""
);


//Update Sub Account using the account ID

SafeHaven::account()->updateSubAccountById(
    "659fed3a48143e0024db7e90",
    "Eminisolomon",
    "SolomonDev",
    "07035014587",
    "SolomonDev@live.com",
    "SolomonDev",
    "22395929708",
    false,
    [],
    [
        "verified" => true,
        "notes" => ""
    ],
    ""
);


//Update Sub Account using the acccount externalReference

SafeHaven::account()->updateSubAccountByReference(
    "SolomonDev",
    "Eminisolomon",
    "SolomonDev",
    "070351223457",
    "SolomonDev@live.com",
    "SolomonDev",
    "22390000708",
    false,
    [],
    [
        "verified" => true,
        "notes" => ""
    ],
    ""
);

//Fetch all account | true for sub account and false for main account
SafeHaven::account()->getAccounts(0, 10, true);


//Fetch a single account with the account ID
SafeHaven::account()->getAccount("659ea57c48143e0024db3eb0");


//Update account notification preferences
SafeHaven::account()->updateAccountPreferences("id:659ea57c48143e0024db3eb0", notificationSettings: [
    "smsNotification" => true,
    "emailNotification" => true,
    "emailMonthlyStatement" => true,
    "smsMonthlyStatement" => true
]);


//Get an account statement using account ID
$accountID = "659ea57c48143e0024db3eb0";
$fromDate = "";
$toDate = "";
$type = "debit";
$page = 0;
$limit = 100;

SafeHaven::account()->getAccountStatement("659ea57c48143e0024db3eb0", $fromDate, $toDate, $type, $page, $limit);
