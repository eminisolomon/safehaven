<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

class VirtualAccountService extends AbstractService
{


    /**
     * Create a virtual account.
     * @param string $accountName
     * @param int $validFor
     * @param string $amountControl
     * @param string $bankCode
     * @param string $accountNumber
     * @param int $amount
     * @param string $callbackUrl
     * @return array
     * @throws SafeHavenException
     */
    public function createAccount(string $accountName, int $validFor = 900, string $amountControl = 'Fixed', string $bankCode = '', string $accountNumber = '', int $amount = 0, string $callbackUrl = ''): array
    {
        $payload = [
            "accountName"         => $accountName,
            "validFor"            => $validFor,
            "settlementAccount"   => ['bankCode' => $bankCode, 'accountNumber' => $accountNumber],
            'amountControl'       => $amountControl,
            'amount'              => $amount,
            'callbackUrl'         => $callbackUrl,
        ];


        $response =  $this->requestor->request('POST',  'virtual-accounts', $payload);

        return  Util::convertToObject($response);
    }

    /**
     * Get virtual account information using the account ID
     * @param string $accountID
     * @return array
     * @throws SafeHavenException
     */
    public function getAccount(string $accountID): array
    {
        $response =  $this->requestor->request('GET',  $this->buildPath('virtual-accounts/%s', $accountID));

        return  Util::convertToObject($response);
    }


    /**
     * Update a virtual account using the account ID
     * @param string $accountID
     * @return array
     * @throws SafeHavenException
     */

    //TODO is this really the only parameters require ?
    public function updateAccount(string $accountID): array
    {
        $response =  $this->requestor->request('PUT',  $this->buildPath('virtual-accounts/%s', $accountID));

        return  Util::convertToObject($response);
    }

    /**
     * Delete a virtual account using the account ID
     * @param string $accountID
     * @return array
     * @throws SafeHavenException
     */
    public function deleteAccount(string $accountID): array
    {
        $response =  $this->requestor->request('DELETE',  $this->buildPath('virtual-accounts/%s', $accountID));

        return  Util::convertToObject($response);
    }

}