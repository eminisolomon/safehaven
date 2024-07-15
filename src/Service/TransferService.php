<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

class TransferService extends AbstractService
{

    /**
     * Get all the bank list
     *
     * @return array
     * @throws SafeHavenException
     */
    public function getBanks(): array
    {
        $response =  $this->requestor->request('GET',  'transfers/banks');

        return  Util::convertToObject($response);
    }

    /**
     * Verify Bank details
     *
     * @param string $bankCode
     * @param string $accountNumber
     * @return array
     * @throws SafeHavenException
     */
    public function verifyBank(string $bankCode, string $accountNumber): array
    {
        $payload = [
            'bankCode' => $bankCode,
            'accountNumber' => $accountNumber
        ];

        $response =  $this->requestor->request('POST',  'transfers/name-enquiry', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Initiate transfer
     * @param string $nameEnquiryReference
     * @param string $debitAccountNumber
     * @param string $beneficiaryBankCode
     * @param string $beneficiaryAccountNumber
     * @param float $amount
     * @param bool $saveBeneficiary
     * @param string $narration
     * @param string $paymentReference
     * @return array
     * @throws SafeHavenException
     */
    public function initiateTransfer(string $nameEnquiryReference, string $debitAccountNumber, string $beneficiaryBankCode, string $beneficiaryAccountNumber, float $amount, bool $saveBeneficiary = false, string $narration = '', string $paymentReference = ''): array
    {
        $payload = [
            'nameEnquiryReference' => $nameEnquiryReference,
            'debitAccountNumber' => $debitAccountNumber,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryAccountNumber' => $beneficiaryAccountNumber,
            'amount' => $amount,
            'saveBeneficiary' => $saveBeneficiary,
            'narration' => $narration,
            'paymentReference' => $paymentReference,
        ];

        $response =  $this->requestor->request('POST',  'transfers', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Get transfer status
     * @param string $sessionId
     * @return array
     * @throws SafeHavenException
     */
    public function getTransferStatus(string $sessionId): array
    {
        $payload = [
            'sessionId' => $sessionId,
        ];

        $response =  $this->requestor->request('POST',  'transfers/status', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Get all account transfer history
     * @param string $accountId
     * @param string $fromDate
     * @param string $toDate
     * @param string $type
     * @param string $status
     * @param int $page
     * @param int $limit
     * @return array
     * @throws SafeHavenException
     */
    public function getTransfers(string $accountId, string $fromDate = '', string $toDate = '', string $type = '', string $status = '', int $page = 0, int $limit = 100): array
    {
        $payload = [
            'accountId' => $accountId,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'type' => $type,
            'status' => $status,
            'page' => $page,
            'limit' => $limit,
        ];

        $response =  $this->requestor->request('GET',  'transfers', $payload);

        return  Util::convertToObject($response);
    }
}