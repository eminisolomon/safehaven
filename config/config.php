<?php

use Eminisolomon\SafeHaven\Client;
use Eminisolomon\SafeHaven\Service\AccountService;
use Eminisolomon\SafeHaven\Service\BeneficiaryService;
use Eminisolomon\SafeHaven\Service\BillingService;
use Eminisolomon\SafeHaven\Service\CheckoutService;
use Eminisolomon\SafeHaven\Service\TransferService;
use Eminisolomon\SafeHaven\Service\UssdPaymentService;
use Eminisolomon\SafeHaven\Service\VerificationService;
use Eminisolomon\SafeHaven\Service\VirtualAccountService;

return [
    'environment' => \getenv('SAFE_HAVEN_ENVIRONMENT') ?: 'sandbox',
    'company_domain' => \getenv('SAFE_HAVEN_COMPANY_DOMAIN') ?: '',
    'client_id' => \getenv('SAFE_HAVEN_CLIENT_ID') ?: '',
    'sandbox_endpoint' => \getenv('SAFE_HAVEN_SANDBOX_ENDPOINT') ?: 'https://api.sandbox.safehavenmfb.com',
    'production_endpoint' => \getenv('SAFE_HAVEN_PRODUCTION_ENDPOINT') ?: 'https://api.safehavenmfb.com',
    'alg' => 'RS256',
    'typ' => 'JWT',
    'services' => [
        'client' => Client::class,
        'account' => AccountService::class,
        'virtual' => VirtualAccountService::class,
        'billing' => BillingService::class,
        'beneficiary' => BeneficiaryService::class,
        'transfer' => TransferService::class,
        'ussd' => UssdPaymentService::class,
        'verification' => VerificationService::class,
        'checkout' => CheckoutService::class,
    ],
    'keys' => [
        'private' => \getenv('SAFE_HAVEN_PRIVATE_KEY') ?: '',
        'public' => \getenv('SAFE_HAVEN_PUBLIC_KEY') ?: '',
    ],
];
