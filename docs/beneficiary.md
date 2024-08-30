# Beneficiary Management

## Get All Beneficiaries

Retrieve a list of all user beneficiaries.

```php
SafeHaven::beneficiary()->getBeneficiaries();
```

## Delete Beneficiary

Remove a beneficiary using its ID.

```php
$accountId = "65a5248080d8020024c82710";
SafeHaven::beneficiary()->deleteBeneficiary($accountId);
```

For more details, please refer to the [Safe Haven's API Account Beneficiary](https://safehavenmfb.readme.io/reference/beneficiaries)
