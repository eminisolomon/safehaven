# Checkout JS Integration

## Display SafeHaven Checkout Button

Embeds the SafeHaven Checkout JS script into your Laravel application, providing a simple payment button.

```html
<div>
  @php $buttonText = "Make Payment"; $customer = ['firstName' => 'John',
  'lastName' => 'Doe', 'emailAddress' => 'johndoe@example.com', 'phoneNumber' =>
  '+2348032273616']; $amount = 100; $settlementAccount = ['bankCode' =>
  '090286', 'accountNumber' => '0113413052']; $redirectUrl =
  'https://example.com/redirect'; $customIconUrl = ''; $webhookUrl = '';
  $metadata = []; @endphp

  <x-safeHaven-checkout
    id="paynow"
    class="btn-primary"
    :$buttonText
    :$customer
    :$amount
    :$settlementAccount
    :$redirectUrl
    :$webhookUrl
    :$customIconUrl
    :$metadata
  />
</div>
```

## Verify Checkout Transaction

Verify the transaction using the reference code provided by Checkout JS.

```php
use Eminisolomon\SafeHaven\SafeHaven;

$referenceCode = "61e985180e69308aa37a7a94";
SafeHaven::checkout()->verifyTransaction($referenceCode);
```

## Events

### JavaScript Event Listeners

In JavaScript, listen to `safeHavenCheckoutClosed` and `safeHavenCheckoutCallback` events:

```javascript
<script>
    document.addEventListener('safeHavenCheckoutClosed', function() {
        console.log("Checkout was closed.");
    });

    document.addEventListener('safeHavenCheckoutCallback', function(e) {
        console.log("Received callback with response:", e.detail);
    });
</script>
```

### Laravel Event Listeners

In Laravel, use event listeners to handle `SafeHavenCheckoutCallbackEvent` and `SafeHavenCheckoutClosedEvent`:

```php
use Eminisolomon\SafeHaven\Events\SafeHavenCheckoutCallbackEvent;
use Eminisolomon\SafeHaven\Events\SafeHavenCheckoutClosedEvent;

// In your EventServiceProvider, register listeners for these events:
protected $listen = [
    SafeHavenCheckoutClosedEvent::class => [
        // Your CheckoutClosedListener class,
    ],
    SafeHavenCheckoutCallbackEvent::class => [
        // Your CheckoutCallbackListener class,
    ],
];
```

The JavaScript listeners react to user interactions with the SafeHaven Checkout UI, while the Laravel event listeners are designed to handle backend responses to these events.

For more details, please refer to the [SafeHaven Checkout JS documentation](https://safehavenmfb.readme.io/reference/checkout-js).
