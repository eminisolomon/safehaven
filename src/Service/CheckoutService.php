<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

class CheckoutService extends AbstractService
{
    /**
     * Verify Checkout Transaction
     *
     * @param  int  $referenceCode
     *
     * @throws SafeHavenException
     */
    public function verifyTransaction(string $referenceCode): array
    {
        $response = $this->requestor->request('GET',
            $this->buildPath('checkout/%s/verify', $referenceCode),
        );

        return Util::convertToObject($response);
    }
}
