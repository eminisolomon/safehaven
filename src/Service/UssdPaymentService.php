<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

class UssdPaymentService extends AbstractService
{
    /**
     * Get the banks supported for USSD payments.
     *
     * @return array
     * @throws SafeHavenException
     */
    public function getBanks(): array
    {
        $response = $this->requestor->request('GET', 'ussd-payment/banks');

        return Util::convertToObject($response);
    }

    /**
     * Create a USSD payment reference.
     *
     * @param string|int|float $amount
     * @param string $merchantName
     * @param string $ussdBankCode
     * @param string $callbackUrl
     * @param array{bankCode:string,accountNumber:string} $settlementAccount
     * @return array
     * @throws SafeHavenException
     */
    public function createReference(
        string|int|float $amount,
        string $merchantName,
        string $ussdBankCode,
        string $callbackUrl,
        array $settlementAccount
    ): array {
        $payload = [
            'amount' => (string) $amount,
            'merchantName' => $merchantName,
            'ussdBankCode' => $ussdBankCode,
            'callbackUrl' => $callbackUrl,
            'settlementAccount' => $settlementAccount,
        ];

        $response = $this->requestor->request('POST', 'ussd-payment', $payload);

        return Util::convertToObject($response);
    }
}
