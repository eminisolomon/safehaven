<?php

use Eminisolomon\SafeHaven\SafeHaven;


//Get all user beneficiary
SafeHaven::beneficiary()->getBeneficiaries();


//delete beneficiary using it's ID
$accountId = "65a5248080d8020024c82710";
SafeHaven::beneficiary()->deleteBeneficiary($accountId);
