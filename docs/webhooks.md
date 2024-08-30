# Webhook Route Setup

## General Webhook Route

Set up a route to handle general webhook payloads. This route captures POST requests and returns the request data.

```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks', function(Request $request){
    return $request;
})->name('webhooks');
```

## Virtual Account Webhook Route

Create a dedicated route for handling virtual account webhook payloads.

```php
Route::post('/webhooks/virtual-account', function(Request $request){
    return $request;
})->name('webhooks.virtual-account');
```

These routes in your Laravel application will listen for POST requests to specific endpoints, allowing you to process webhook payloads effectively.

For more information, refer to Laravel's official documentation on [routing](https://laravel.com/docs/routing) and also see the [SafeHaven Webhooks documentation](https://safehavenmfb.readme.io/reference/webhooks).
