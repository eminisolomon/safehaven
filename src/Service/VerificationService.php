<?php

namespace MaylancerDev\SafeHaven\Service;

use MaylancerDev\SafeHaven\Exceptions\SafeHavenException;
use MaylancerDev\SafeHaven\Util\Util;

class VerificationService extends AbstractService
{

    /**
     * Verify BVN
     *
     * @param string $number
     * @param string $phoneNumber
     * @param string $otp
     * @param string $oneTimePassword
     * @param string $debitAccountNumber
     * @param string $type
     * @param bool $async
     * @return array
     * @throws SafeHavenException
     */
    public function confirmBankVerificationNumber(string $number, string $phoneNumber, string $otp, string $oneTimePassword, string $debitAccountNumber, string $type = "BVN", bool $async = false): array
    {
        $payload  = [
            'type' => $type,
            'number' => $number,
            'phoneNumber' => $phoneNumber,
            'otp' => $otp,
            'otpId' => $oneTimePassword,
            'debitAccountNumber' => $debitAccountNumber,
            'async' => $async,
        ];
        $response =  $this->requestor->request('POST',  'identity', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Verify NIN, CAC, and credit
     *
     * @param string $type
     * @param string $number
     * @param string $debitAccountNumber
     * @param string $provider
     * @param bool $async
     * @return array
     * @throws SafeHavenException
     */
    public function validateIdentity(string $type, string $number, string $debitAccountNumber, string $provider, bool $async = false): array
    {
        $payload  = [
            'type' => $type,
            'number' => $number,
            'debitAccountNumber' => $debitAccountNumber,
            'provider' => $provider,
            'async' => $async,
        ];
        $response =  $this->requestor->request('POST',  'identity', $payload);

        return  Util::convertToObject($response);
    }


    /**
     * Send one-time password for BVN verification
     *
     * @param string $number
     * @return array
     * @throws SafeHavenException
     */
    public function dispatchOtpToNumber(string $number): array
    {
        $payload  = [
            'number' => $number,
        ];
        $response =  $this->requestor->request('POST',  'identity/send-otp', $payload);

        return  Util::convertToObject($response);
    }

}
