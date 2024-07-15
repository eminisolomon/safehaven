<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;
use Eminisolomon\SafeHaven\Util\Util;

class BeneficiaryService extends AbstractService
{

    /**
     * Get all beneficiaries
     * @return array
     * @throws SafeHavenException
     */
    public function getBeneficiaries(): array
    {
        $response =  $this->requestor->request('GET',  'transfers/beneficiaries');

        return  Util::convertToObject($response);
    }


    /**
     * Delete Beneficiary
     * @param string $beneficiaryId
     * @return array
     * @throws SafeHavenException
     */
    public function deleteBeneficiary(string $beneficiaryId): array
    {
        $response =  $this->requestor->request('DELETE',  $this->buildPath('transfers/beneficiaries/%s', $beneficiaryId));

        return  Util::convertToObject($response);
    }

}