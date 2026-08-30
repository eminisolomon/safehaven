<?php

namespace Eminisolomon\SafeHaven\Tests\Unit;

use Eminisolomon\SafeHaven\ApiRequestor;
use Eminisolomon\SafeHaven\Service\AccountService;
use Eminisolomon\SafeHaven\Service\BillingService;
use Eminisolomon\SafeHaven\Service\UssdPaymentService;
use Eminisolomon\SafeHaven\Service\VirtualAccountService;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Mockery;

class ServiceEndpointTest extends \Eminisolomon\SafeHaven\Tests\TestCase
{
    private function response(array $body): Response
    {
        return new Response(new PsrResponse(200, [], json_encode($body)));
    }

    public function test_virtual_account_transfer_status_is_requested(): void
    {
        $requestor = Mockery::mock(ApiRequestor::class);
        $requestor->expects('request')
            ->with('POST', 'virtual-accounts/status', ['sessionId' => 'session-123'])
            ->andReturn($this->response(['statusCode' => 200]));

        $service = new VirtualAccountService();
        $service->requestor = $requestor;

        $this->assertSame(['statusCode' => 200], $service->getTransferStatus('session-123'));
    }

    public function test_virtual_transaction_is_requested_by_account_id(): void
    {
        $requestor = Mockery::mock(ApiRequestor::class);
        $requestor->expects('request')
            ->with('GET', 'virtual-accounts/account-123/transaction')
            ->andReturn($this->response(['statusCode' => 200]));

        $service = new VirtualAccountService();
        $service->requestor = $requestor;

        $this->assertSame(['statusCode' => 200], $service->getTransaction('account-123'));
    }

    public function test_corporate_sub_account_contains_corporate_identity_fields(): void
    {
        $requestor = Mockery::mock(ApiRequestor::class);
        $requestor->expects('request')
            ->with('POST', 'accounts/v2/subaccount/', [
                'phoneNumber' => '+2348012345678',
                'emailAddress' => 'company@example.test',
                'externalReference' => 'company-ref',
                'identityType' => 'vID',
                'identityId' => 'identity-123',
                'companyRegistrationNumber' => 'RC123456',
                'callbackUrl' => 'https://example.test/callback',
                'autoSweep' => false,
                'autoSweepDetails' => [],
            ])
            ->andReturn($this->response(['statusCode' => 200]));

        $service = new AccountService();
        $service->requestor = $requestor;

        $this->assertSame(
            ['statusCode' => 200],
            $service->createCorporateSubAccount(
                '+2348012345678',
                'company@example.test',
                'company-ref',
                'identity-123',
                'RC123456',
                'https://example.test/callback'
            )
        );
    }

    public function test_ussd_banks_are_requested(): void
    {
        $requestor = Mockery::mock(ApiRequestor::class);
        $requestor->expects('request')
            ->with('GET', 'ussd-payment/banks')
            ->andReturn($this->response(['data' => []]));

        $service = new UssdPaymentService();
        $service->requestor = $requestor;

        $this->assertSame(['data' => []], $service->getBanks());
    }

    public function test_ussd_reference_is_created_with_settlement_account(): void
    {
        $requestor = Mockery::mock(ApiRequestor::class);
        $requestor->expects('request')
            ->with('POST', 'ussd-payment', [
                'amount' => '2500',
                'merchantName' => 'Test Merchant',
                'ussdBankCode' => '901',
                'callbackUrl' => 'https://example.test/callback',
                'settlementAccount' => [
                    'bankCode' => '090286',
                    'accountNumber' => '0112345678',
                ],
            ])
            ->andReturn($this->response(['statusCode' => 200]));

        $service = new UssdPaymentService();
        $service->requestor = $requestor;

        $this->assertSame(
            ['statusCode' => 200],
            $service->createReference(
                2500,
                'Test Merchant',
                '901',
                'https://example.test/callback',
                ['bankCode' => '090286', 'accountNumber' => '0112345678']
            )
        );
    }

    public function test_data_bundle_uses_the_data_payment_endpoint(): void
    {
        $requestor = Mockery::mock(ApiRequestor::class);
        $requestor->expects('request')
            ->with('POST', 'vas/pay/data', [
                'serviceCategoryId' => 'category-123',
                'phoneNumber' => '+2348012345678',
                'debitAccountNumber' => '0112345678',
                'amount' => 1000.0,
                'bundleCode' => 'MTN-1GB',
                'channel' => 'WEB',
                'statusUrl' => '',
            ])
            ->andReturn($this->response(['statusCode' => 200]));

        $service = new BillingService();
        $service->requestor = $requestor;

        $this->assertSame(
            ['statusCode' => 200],
            $service->purchaseDataBundle(
                'category-123',
                '+2348012345678',
                '0112345678',
                1000,
                'MTN-1GB'
            )
        );
    }
}
