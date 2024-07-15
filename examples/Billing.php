<?php

use Eminisolomon\SafeHaven\SafeHaven;


//Get all billables
SafeHaven::billing()->getServices();


//Get a billing details by Billing ID
$billableID = '61e985180e69308aa37a7a94';
SafeHaven::billing()->getService($billableID);


//Get Service Category Products
$billableID = "61e98c7790dbbfc905f48f13";
SafeHaven::billing()->getServiceCategoryProducts($billableID);

//Verify bill account for utility bill
SafeHaven::billing()->verifyCableBillable(
    "61e98c7790dbbfc905f48f13",
    "62421230525"
);


//Pay bills using category ID and meter number
SafeHaven::billing()->payUtilityBill(
    "61e98c7790dbbfc905f48f13",
    "62421230525",
    "0111297393",
    "4000"
);

//Purchase Airtime with this endpoin
$billableID = "61e988830e69308aa37a7a99";
SafeHaven::billing()->purchaseAirtime(
    $billableID,
    "09036604001",
    "0111297393",
    "100"
);

// Get Service Category
//Please not this make use of service ID not the main ID
$billableServiceID = "61e989f20e69308aa37a7a9f";
SafeHaven::billing()->getServiceCategoryProducts($billableServiceID);


//Purchase data bundle
$billableServiceID = "61e989f20e69308aa37a7a9f";
SafeHaven::billing()->purchaseDataBundle(
    $billableServiceID,
    "09036604001",
    "0111297393",
    "900",
    "MTN-3GB"
);


//Purchase cable tv subscription
$billableServiceID = "61e98b6462d9b6a917f9302d";
SafeHaven::billing()->purchaseCableTVSubscription(
    $billableServiceID,
    "4622584834",
    "0111297393",
    "GOLITE",
    "2900.00"
);

//This returns all the previous vas transactions of the logged in client.
SafeHaven::billing()->getBillingTransactions();

//Gat a single billing transaction using the transaction ID
SafeHaven::billing()->getBillingTransaction("65a2a97cacb5e2165333a8ec");
