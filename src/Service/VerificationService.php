<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

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
     * initiate verification using different types (BVN, NIN, CREDITCHECK).
     *
     * @param string $type Type of verification (e.g., BVN, NIN, CREDITCHECK).
     * @param string $number Verification number.
     * @param string $debitAccountNumber Account number to debit.
     * @param string|null $otp One-time password, only for BVNUSSD.
     * @param string|null $verifierId Verifier ID, only for vNIN.
     * @param string|null $provider Provider for CREDITCHECK (creditRegistry, firstCentral).
     * @param bool|null $async Asynchronous request flag, defaults to true for CREDITCHECK.
     * @return array Response from the SafeHaven API.
     * @throws SafeHavenException
     */
    public function initiateVerification(
        string $type,
        string $number,
        string $debitAccountNumber,
        ?string $otp = null,
        ?string $verifierId = null,
        ?string $provider = null,
        ?bool $async = true
    ): array {
        $payload  = [
            'type'                  => $type,
            'number'                => $number,
            'debitAccountNumber'    => $debitAccountNumber,
            'otp'                   => $otp,
            'verifierId'            => $verifierId,
            'provider'              => $provider,
            'async'                 => $async,
        ];
        $response =  $this->requestor->request('POST',  'identity/v2', $payload);

        return  Util::convertToObject($response);
    }

    /**
     * Verify Identification by validating the OTP for BVN or NIN verification.
     *
     * @param string $identityId The ID captured from the initial request.
     * @param string $type Type of verification (e.g., BVN, NIN).
     * @param string $otp The OTP sent to the customer's phone number.
     * @return array Response from the SafeHaven API.
     * @throws SafeHavenException
     */
    public function verifyIdentification(string $identityId, string $type, string $otp): array
    {
        $payload = [
            'identityId' => $identityId,
            'type' => $type,
            'otp' => $otp,
        ];

        $response = $this->requestor->request('POST', 'identity/v2/validate', $payload);

        return Util::convertToObject($response);
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
