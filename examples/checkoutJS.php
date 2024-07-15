<div>
    @php
    $buttonText = "Make Payment";
    $customer = [
    'firstName' => 'John',
    'lastName' => 'Doe',
    'emailAddress' => 'johndoe@example.com',
    'phoneNumber' => '+2348032273616'
    ];
    $amount = 100;
    $settlementAccount = [
    'bankCode' => '090286', // '999240' for Sandbox, '090286' for Production
    'accountNumber' => '0113413052'
    ];
    $redirectUrl = 'https://example.com/redirect';
    $customIconUrl = '';
    $webhookUrl = '';
    $metadata = [];
    @endphp

    <x-safeHaven-checkout id="paynow" class="btn-primary" :$buttonText :$customer :$amount :$settlementAccount :$redirectUrl :$webhookUrl :$customIconUrl :$metadata />


    //Listen to callback events in your checkout page
    <script>
        document.addEventListener('safeHavenCheckoutClosed', function() {
            console.log("Checkout was closed.");
        });

        document.addEventListener('safeHavenCheckoutCallback', function(e) {
            console.log("Received callback with response:", e.detail);
        });
    </script>


</div>

<?php

use Eminisolomon\SafeHaven\SafeHaven;

//Verify checkout transaction with the referenceCode from the checkout.js
$referenceCode = "61e985180e69308aa37a7a94";
SafeHaven::checkout()->verifyTransaction($referenceCode);
