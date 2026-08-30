<?php

namespace Eminisolomon\SafeHaven;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Client client()
 * @method static Service\AccountService account()
 * @method static Service\VirtualAccountService virtual()
 * @method static Service\BillingService billing()
 * @method static Service\BeneficiaryService beneficiary()
 * @method static Service\TransferService transfer()
 * @method static Service\UssdPaymentService ussd()
 * @method static Service\VerificationService verification()
 * @method static Service\CheckoutService checkout()
 */
class SafeHaven extends Facade
{
    /**
     * @return string
     *
     * @see Manager
     */
    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
