<?php

namespace Eminisolomon\SafeHaven\Renderers;


use Illuminate\View\Component;
use Illuminate\View\View;

class SafeHavenBladeComponent extends Component
{

    public   $customer;
    public   $amount;
    public   $settlementAccount;
    public   $redirectUrl;
    public   $webhookUrl;
    public   $customIconUrl;
    public   $metadata;

    public   $buttonText;


    public function __construct(
        string $buttonText,
        float $amount,
        array $customer,
        array $settlementAccount,
        string $redirectUrl,
        string $webhookUrl = '',
        string $customIconUrl = '',
        array $metadata = [],
    ) {
        $this->buttonText         = $buttonText;
        $this->amount             = $amount;
        $this->customer           = $customer;
        $this->settlementAccount  = $settlementAccount;
        $this->redirectUrl        = $redirectUrl;
        $this->webhookUrl         = $webhookUrl;
        $this->customIconUrl      = $customIconUrl;
        $this->metadata           = $metadata;
    }

    public function render(): View
    {
        return view('safehaven::checkout');
    }
}
