<?php

use Eminisolomon\SafeHaven\Http\Controllers\SafeHavenCheckoutController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'safehaven', 'as' => 'safehaven::'], function () {
    Route::post('/checkout-closed', [SafeHavenCheckoutController::class, 'handleCheckoutClosed'])->name('checkout-close');
    Route::post('/checkout-callback', [SafeHavenCheckoutController::class, 'handleCheckoutCallback'])->name('checkout-callback');
});
