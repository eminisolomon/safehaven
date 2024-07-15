<?php

namespace Eminisolomon\SafeHaven\Http\Controllers;

use Illuminate\Http\Request;
use Eminisolomon\SafeHaven\Events\SafeHavenCheckoutCallbackEvent;
use Eminisolomon\SafeHaven\Events\SafeHavenCheckoutClosedEvent;

class SafeHavenCheckoutController
{

    public function handleCheckoutClosed(Request $request)
    {
        event(new SafeHavenCheckoutClosedEvent($request->all()));
        return response()->json(['success' => true]);
    }


    public function handleCheckoutCallback(Request $request)
    {
        event(new SafeHavenCheckoutCallbackEvent($request->all()));
        return response()->json(['success' => true]);
    }

}