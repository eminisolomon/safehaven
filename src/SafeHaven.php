<?php

namespace Eminisolomon\SafeHaven;

use Illuminate\Support\Facades\Facade;

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
