<?php

namespace Eminisolomon\SafeHaven\Tests\Feature;

use Eminisolomon\SafeHaven\SafeHaven;
use Eminisolomon\SafeHaven\Service\AccountService;
use Eminisolomon\SafeHaven\Service\BillingService;
use Eminisolomon\SafeHaven\Service\CheckoutService;
use Eminisolomon\SafeHaven\Service\TransferService;
use Eminisolomon\SafeHaven\Service\UssdPaymentService;
use Eminisolomon\SafeHaven\Service\VerificationService;
use Eminisolomon\SafeHaven\Service\VirtualAccountService;
use Eminisolomon\SafeHaven\Tests\TestCase;

class PackageIntegrationTest extends TestCase
{
    public function test_package_registers_all_public_services_on_the_facade(): void
    {
        $this->assertInstanceOf(AccountService::class, SafeHaven::account());
        $this->assertInstanceOf(VirtualAccountService::class, SafeHaven::virtual());
        $this->assertInstanceOf(BillingService::class, SafeHaven::billing());
        $this->assertInstanceOf(TransferService::class, SafeHaven::transfer());
        $this->assertInstanceOf(UssdPaymentService::class, SafeHaven::ussd());
        $this->assertInstanceOf(VerificationService::class, SafeHaven::verification());
        $this->assertInstanceOf(CheckoutService::class, SafeHaven::checkout());
    }

    public function test_service_instances_are_shared_by_the_manager(): void
    {
        $this->assertSame(SafeHaven::ussd(), SafeHaven::ussd());
        $this->assertSame(SafeHaven::billing(), SafeHaven::billing());
    }
}
