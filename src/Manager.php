<?php

namespace Eminisolomon\SafeHaven;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class Manager
{
    use Macroable;


    /**
     * @var null|callable
     */
    protected $getConfigUsing;

    private static $instances = [];

    private static function getInstance($class)
    {
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }

    public static function initializeMacros(): void
    {
        $services = SafeHaven::config('services');

        foreach ($services as $name => $class) {
            self::macro($name, function () use ($class) {
                return self::getInstance($class);
            });
        }
    }

    /**
     * Get an item out of the config using dot notation.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function config($key, $default = null)
    {
        // Default to Laravel's config method.
        $method = $this->getConfigUsing ?? 'config';

        // If we are using Laravel's config method, then we'll prepend
        // the key with `safehaven` if it isn't already there.
        if ($method === 'config') {
            $key = Str::start($key, 'safehaven.');
        }

        return call_user_func($method, $key, $default);
    }

    /**
     * A callback function used to access configuration. By default this
     * is null, which will fall through to Laravel's `config` function.
     *
     * @param  $callback
     */
    public function getConfigUsing($callback)
    {
        if (is_array($callback)) {
            $callback = function ($key, $default) use ($callback) {
                return Arr::get($callback, $key, $default);
            };
        }

        $this->getConfigUsing = $callback;
    }
}
