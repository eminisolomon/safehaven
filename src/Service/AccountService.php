<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

class AccountService extends AbstractService
{
    /**
     * This returns the list of accounts
     *
     * @throws SafeHavenException
     */
    public function getAccounts(int $page = 0, int $limit = 100, bool $isSubAccount = false): array
    {
        $payload = [
            'page' => $page,
            'limit' => $limit,
            'isSubAccount' => $isSubAccount,
        ];
        $response = $this->requestor->request('GET', 'accounts', $payload);

        return Util::convertToObject($response);
    }

    /**
     * Get account information using account ID
     *
     * @throws SafeHavenException
     */
    public function getAccount(string $accountID): array
    {
        $response = $this->requestor->request('GET', $this->buildPath('accounts/%s', $accountID));

        return Util::convertToObject($response);
    }

    /**
     * This creates a new account under your profile.
     *
     * @throws SafeHavenException
     */
    public function createAccount(string $accountType, string $suffix, array $metadata): array
    {
        $payload = [
            'accountType' => $accountType,
            'suffix' => $suffix,
            'metadata' => json_encode($metadata),
        ];
        $response = $this->requestor->request('POST', 'accounts', $payload);

        return Util::convertToObject($response);
    }

    /**
     * Creates a new sub-account based on the specified information in the request body.
     *
     * @throws SafeHavenException
     */
    public function createSubAccount(
        string $phoneNumber,
        string $emailAddress,
        string $externalReference,
        string $identityType,
        ?string $identityNumber = null,
        ?string $identityId = null,
        ?string $otp = null,
        bool $autoSweep = false,
        array $autoSweepDetails = [],
        array $metadata = [],
        string $callbackUrl = '',
    ): array {
        $payload = [
            'phoneNumber' => $phoneNumber,
            'emailAddress' => $emailAddress,
            'externalReference' => $externalReference,
            'identityType' => $identityType,
            'identityNumber' => $identityNumber,
            'identityId' => $identityId,
            'otp' => $otp,
            'autoSweep' => $autoSweep,
            'autoSweepDetails' => $autoSweepDetails,
            'callbackUrl' => $callbackUrl,
            'metadata' => $metadata,
        ];
        $response = $this->requestor->request('POST', 'accounts/v2/subaccount', $payload);

        return Util::convertToObject($response);
    }

    /**
     * Create a corporate sub-account after validating a company director.
     *
     * @throws SafeHavenException
     */
    public function createCorporateSubAccount(
        string $phoneNumber,
        string $emailAddress,
        string $externalReference,
        string $identityId,
        string $companyRegistrationNumber,
        string $callbackUrl = '',
        bool $autoSweep = false,
        array $autoSweepDetails = [],
    ): array {
        $payload = [
            'phoneNumber' => $phoneNumber,
            'emailAddress' => $emailAddress,
            'externalReference' => $externalReference,
            'identityType' => 'vID',
            'identityId' => $identityId,
            'companyRegistrationNumber' => $companyRegistrationNumber,
            'callbackUrl' => $callbackUrl,
            'autoSweep' => $autoSweep,
            'autoSweepDetails' => $autoSweepDetails,
        ];

        $response = $this->requestor->request('POST', 'accounts/v2/subaccount/', $payload);

        return Util::convertToObject($response);
    }

    /**
     * Update sub-account using account  ID and based on the specified information in the request body
     *
     * @throws SafeHavenException
     */
    public function updateSubAccountById(string $accountID, string $firstName, string $lastName, string $phoneNumber, string $emailAddress, string $externalReference, string $bvn, bool $autoSweep = false, array $autoSweepDetails = [], array $metadata = [], string $callbackUrl = ''): array
    {
        $payload = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'phoneNumber' => $phoneNumber,
            'emailAddress' => $emailAddress,
            'externalReference' => $externalReference,
            'bvn' => $bvn,
            'autoSweepDetails' => json_encode($autoSweepDetails),
            'autoSweep' => $autoSweep,
            'callbackUrl' => $callbackUrl,
            'metadata' => json_encode($metadata),
        ];
        $response = $this->requestor->request('PUT', $this->buildPath('accounts/%s/subaccount', $accountID), $payload);

        return Util::convertToObject($response);
    }

    /**
     *  Update sub account using account externalReference and based on the specified information in the request body
     *
     * @throws SafeHavenException
     */
    public function updateSubAccountByReference(string $reference, string $firstName, string $lastName, string $phoneNumber, string $emailAddress, string $externalReference, string $bvn, bool $autoSweep = false, array $autoSweepDetails = [], array $metadata = [], string $callbackUrl = ''): array
    {
        $payload = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'phoneNumber' => $phoneNumber,
            'emailAddress' => $emailAddress,
            'externalReference' => $externalReference,
            'bvn' => $bvn,
            'autoSweepDetails' => json_encode($autoSweepDetails),
            'autoSweep' => $autoSweep,
            'callbackUrl' => $callbackUrl,
            'metadata' => json_encode($metadata),
        ];
        $response = $this->requestor->request('PUT', $this->buildPath('accounts/%s/subaccount', $reference), $payload);

        return Util::convertToObject($response);
    }

    /**
     * Update account notification preferences
     *
     * @throws SafeHavenException
     */
    public function updateAccountPreferences(string $accountID, array $notificationSettings = []): array
    {
        $payload = ['notificationSettings' => $notificationSettings];

        $response = $this->requestor->request('PUT', $this->buildPath('accounts/%s', $accountID), $payload);

        return Util::convertToObject($response);
    }

    public function getAccountStatement(string $accountID, string $fromDate = '', string $toDate = '', string $type = 'debit', int $page = 0, int $limit = 100): array
    {
        $payload = [
            'page' => $page,
            'limit' => $limit,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'type' => $type,
        ];

        $response = $this->requestor->request('GET', $this->buildPath('accounts/%s/statement', $accountID), $payload);

        return Util::convertToObject($response);
    }
}
