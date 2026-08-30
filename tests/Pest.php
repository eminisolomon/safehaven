<?php

use Eminisolomon\SafeHaven\Tests\TestCase;

if (! function_exists('uses')) {
    return;
}

uses(TestCase::class)->in('Feature', 'Unit');
