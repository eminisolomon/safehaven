<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Add this webhoot to your route to get the payload data
Route::post('/webhooks', function(Request $request){
    return $request;
})->name('webhooks');
Route::post('/webhooks/virtual-account', function(Request $request){
    return $request;
})->name('webhooks.virtual-account');

