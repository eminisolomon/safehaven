<?php

use Eminisolomon\SafeHaven\SafeHaven;

// Get a list of available  banks
SafeHaven::transfer()->getBanks();


//Verify account number
//Sandbox environment always uses 999240 as the bank code
//the account number can be any account number created on the Sandbox
$accountNumber = "0106296301";
$bankCode = "999240";

SafeHaven::transfer()->verifyBank($bankCode, $accountNumber);


//Initiate a transfer
// please note you will need a sessionId from the account verification
$nameEnquiryReference = "999240240115121423216610677133";
$debitAccountNumber = "0111297393";
$beneficiaryBankCode = "999240";
$beneficiaryAccountNumber = "0106296301";
$amount = "200";
$saveBeneficiary = true;

SafeHaven::transfer()->initiateTransfer(
    $nameEnquiryReference,
    $debitAccountNumber,
    $beneficiaryBankCode,
    $beneficiaryAccountNumber,
    $amount,
    $saveBeneficiary
);


// get transaction status
$sessionId = "999240240115123132300429164435";
SafeHaven::transfer()->getTransferStatus($sessionId);


//Get account transactions
$accountId = "659d4c6c6aeb250024bcc592";
SafeHaven::transfer()->getTransfers($accountId);
