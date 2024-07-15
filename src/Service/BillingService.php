<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

class BillingService extends AbstractService
{
    /**
     * Get all billing services
     * @return array
     * @throws SafeHavenException
     */
    public function getServices(): array
    {
       $response =  $this->requestor->request('GET',  'vas/services');

       return  Util::convertToObject($response);
   }


    /**
     * Get VAS Transactions
     * @return array
     * @throws SafeHavenException
     */
    public function getBillingTransactions(): array
    {
        $response =  $this->requestor->request('GET',  'vas/transactions');

        return  Util::convertToObject($response);
    }



    public function getBillingTransaction($transactionID): array
    {
        $response =  $this->requestor->request('GET',  $this->buildPath('vas/transaction/%s', $transactionID));

        return  Util::convertToObject($response);
    }


    /**
     * This returns the object of the specified service using the id.
      * @param string $billableID
     * @return array
     * @throws SafeHavenException
     */
    public function getService(string $billableID): array
    {
        $response =  $this->requestor->request('GET', $this->buildPath('vas/service/%s', $billableID));

        return  Util::convertToObject($response);
    }


    /**
     * This endpoint returns all the available products and offers under a specific category.
     * @param string $billableID
     * @return array
     * @throws SafeHavenException
     */
    public function getServiceCategories(string $billableID): array
    {
        $response =  $this->requestor->request('GET', $this->buildPath('vas/service/%s/service-categories', $billableID));

        return  Util::convertToObject($response);
    }


    /**
     * Get Service Category Products
     *
     * @param string $categoryID
     * @return array
     * @throws SafeHavenException
     */
    public function getServiceCategoryProducts(string $categoryID): array
    {
        $response =  $this->requestor->request('GET', $this->buildPath('vas/service-category/%s/products', $categoryID));

        return  Util::convertToObject($response);
    }


    /**
     * Verify utility using category ID and Utility number
     * @param string $serviceCategoryId
     * @param string $entityNumber
     * @return array
     * @throws SafeHavenException
     */
    public function verifyCableBillable(string $serviceCategoryId, string $entityNumber): array
    {
        $payload = [
            'serviceCategoryId' => $serviceCategoryId,
            'entityNumber' => $entityNumber
        ];
        $response =  $this->requestor->request('POST', 'vas/verify', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Purchase Utility service
     * @param string $serviceCategoryId
     * @param string $meterNumber
     * @param string $debitAccountNumber
     * @param float $amount
     * @param string $channel
     * @param string $vendType
     * @return array
     * @throws SafeHavenException
     */
    public function payUtilityBill(string $serviceCategoryId, string $meterNumber, string $debitAccountNumber, float $amount, string $channel = "WEB", string $vendType ='PREPAID'): array
    {
        $payload = [
            'amount' => $amount,
            'channel' => $channel,
            'debitAccountNumber' => $debitAccountNumber,
            'serviceCategoryId' => $serviceCategoryId,
            'meterNumber' => $meterNumber,
            'vendType' => $vendType,
         ];
        $response =  $this->requestor->request('POST', 'vas/pay/utility', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Airtime purchase
     *
     * @param string $serviceCategoryId
     * @param string $phoneNumber
     * @param string $debitAccountNumber
     * @param float $amount
     * @param string $channel
     * @param string $statusUrl
     * @return array
     * @throws SafeHavenException
     */
    public function purchaseAirtime(string $serviceCategoryId, string $phoneNumber, string $debitAccountNumber, float $amount, string $channel = "WEB", string $statusUrl = ''): array
    {
        $payload = [
            'amount' => $amount,
            'channel' => $channel,
            'debitAccountNumber' => $debitAccountNumber,
            'serviceCategoryId' => $serviceCategoryId,
            'phoneNumber' => $phoneNumber,
            'statusUrl' => $statusUrl,
        ];

        $response =  $this->requestor->request('POST', 'vas/pay/airtime', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Purchase a data bundle.
     * @param string $serviceCategoryId
     * @param string $phoneNumber
     * @param string $debitAccountNumber
     * @param float $amount
     * @param string $bundleCode
     * @param string $channel
     * @param string $statusUrl
     * @return array
     * @throws SafeHavenException
     */
    public function purchaseDataBundle(string $serviceCategoryId, string $phoneNumber, string $debitAccountNumber, float $amount, string $bundleCode, string $channel = "WEB", string $statusUrl = ''): array
    {
        $payload = [
            'serviceCategoryId' => $serviceCategoryId,
            'phoneNumber' => $phoneNumber,
            'debitAccountNumber' => $debitAccountNumber,
            'amount' => $amount,
            'bundleCode' => $bundleCode,
            'channel' => $channel,
            'statusUrl' => $statusUrl,
        ];

        $response =  $this->requestor->request('POST', 'vas/pay/airtime', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Purchase a cable tv subscription
     * @param string $serviceCategoryId
     * @param string $cardNumber
     * @param string $debitAccountNumber
     * @param string $bundleCode
     * @param float $amount
     * @param string $channel
     * @return array
     * @throws SafeHavenException
     */
    public function purchaseCableTVSubscription(string $serviceCategoryId, string $cardNumber, string $debitAccountNumber, string $bundleCode, float $amount, string $channel = "WEB"): array
    {
        $payload = [
            'serviceCategoryId' => $serviceCategoryId,
            'debitAccountNumber' => $debitAccountNumber,
            'amount' => $amount,
            'bundleCode' => $bundleCode,
            'cardNumber' => $cardNumber,
            'channel' => $channel,
        ];

        $response =  $this->requestor->request('POST', 'vas/pay/cable-tv', $payload);

        return  Util::convertToObject($response);
    }

}