# Billing Management

## Get All Billables

Retrieve all available billable services.

```php
SafeHaven::billing()->getServices();
```

## Get Billing Details by ID

Get details of a specific billing service using its ID.

```php
$billableID = '61e985180e69308aa37a7a94'; // Billing Service ID
SafeHaven::billing()->getService($billableID);
```

## Get Service Category Products

Retrieve products within a specific service category.

```php
$categoryID = "61e98c7790dbbfc905f48f13"; // Category ID
SafeHaven::billing()->getServiceCategoryProducts($categoryID);
```

## Verify Cable Billable

Verify a cable service billable account.

```php
$categoryID = "61e98c7790dbbfc905f48f13"; // Category ID
$billableAccount = "62421230525";         // Billable Account Number
SafeHaven::billing()->verifyCableBillable($categoryID, $billableAccount);
```

## Pay Utility Bill

Pay bills for utilities like electricity.

```php
$categoryID = "61e98c7790dbbfc905f48f13"; // Category ID
$meterNumber = "62421230525";             // Meter Number
$customerID = "0111297393";               // Customer ID
$amount = "4000";                         // Amount to Pay
SafeHaven::billing()->payUtilityBill($categoryID, $meterNumber, $customerID, $amount);
```

## Purchase Airtime

Buy airtime for a mobile number.

```php
$serviceID = "61e988830e69308aa37a7a99"; // Service ID
$phoneNumber = "09036612345";            // Phone Number
$customerID = "0111297393";              // Customer ID
$amount = "100";                         // Amount
SafeHaven::billing()->purchaseAirtime($serviceID, $phoneNumber, $customerID, $amount);
```

## Purchase Data Bundle

Buy a data bundle for a mobile number.

```php
$serviceID = "61e989f20e69308aa37a7a9f"; // Service ID
$phoneNumber = "09036612345";            // Phone Number
$customerID = "0111297393";              // Customer ID
$amount = "900";                         // Amount
$bundleCode = "MTN-3GB";                 // Bundle Code
SafeHaven::billing()->purchaseDataBundle($serviceID, $phoneNumber, $customerID, $amount, $bundleCode);
```

## Purchase Cable TV Subscription

Subscribe to a cable TV package.

```php
$serviceID = "61e98b6462d9b6a917f9302d"; // Service ID
$decoderNumber = "4622584834";           // Decoder Number
$customerID = "0111297393";              // Customer ID
$packageCode = "GOLITE";                 // Package Code
$amount = "2900.00";                     // Amount
SafeHaven::billing()->purchaseCableTVSubscription($serviceID, $decoderNumber, $customerID, $packageCode, $amount);
```

## Get Billing Transactions

Retrieve all past billing transactions.

```php
SafeHaven::billing()->getBillingTransactions();
```

## Get Single Billing Transaction

Get details of a specific billing transaction using its ID.

```php
$transactionID = "65a2a97cacb5e2165333a8ec"; // Transaction ID
SafeHaven::billing()->getBillingTransaction($transactionID);
```

For more details, please refer to the [Safe Haven's API endpoints to get all available services and required parameters](https://safehavenmfb.readme.io/reference/vas-transactions).
