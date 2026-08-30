<?php

namespace Eminisolomon\SafeHaven;

use Eminisolomon\SafeHaven\Service\AccountService;
use Eminisolomon\SafeHaven\Service\BeneficiaryService;
use Eminisolomon\SafeHaven\Service\BillingService;
use Eminisolomon\SafeHaven\Service\CheckoutService;
use Eminisolomon\SafeHaven\Service\TransferService;
use Eminisolomon\SafeHaven\Service\UssdPaymentService;
use Eminisolomon\SafeHaven\Service\VerificationService;
use Eminisolomon\SafeHaven\Service\VirtualAccountService;

class SafeHavenClient
{
    private array $services = [];

    public function __construct(private readonly ApiRequestor $requestor) {}

    public static function fromEnvironment(): self
    {
        return new self(new ApiRequestor(Configuration::fromEnvironment()));
    }

    public function account(): AccountService
    {
        return $this->service(AccountService::class);
    }

    public function virtual(): VirtualAccountService
    {
        return $this->service(VirtualAccountService::class);
    }

    public function billing(): BillingService
    {
        return $this->service(BillingService::class);
    }

    public function beneficiary(): BeneficiaryService
    {
        return $this->service(BeneficiaryService::class);
    }

    public function transfer(): TransferService
    {
        return $this->service(TransferService::class);
    }

    public function ussd(): UssdPaymentService
    {
        return $this->service(UssdPaymentService::class);
    }

    public function verification(): VerificationService
    {
        return $this->service(VerificationService::class);
    }

    public function checkout(): CheckoutService
    {
        return $this->service(CheckoutService::class);
    }

    private function service(string $class): object
    {
        return $this->services[$class] ??= new $class($this->requestor);
    }
}
