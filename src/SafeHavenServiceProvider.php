<?php

namespace Eminisolomon\SafeHaven;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Eminisolomon\SafeHaven\Renderers\SafeHavenBladeComponent;

class SafeHavenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {


        $this->loadComponents();
        $this->loadPublishables();
        $this->bindManagerSingleton();
        $this->getInitializeMacros();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'safehaven');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');



    }



    public function bindManagerSingleton()
    {
        $this->app->singleton(Manager::class, function () {
            return new Manager;
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'safehaven');

    }

    /**
     * @return void
     */
    public function getInitializeMacros(): void
    {
        Manager::initializeMacros();
    }

    /**
     * @return void
     */
    public function loadPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('safehaven.php'),
            ], 'config');


            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/safehaven'),
            ], 'views');
        }
    }

    /**
     * @return void
     */
    public function loadComponents(): void
    {
        Blade::component('safeHaven-checkout', SafeHavenBladeComponent::class);
    }
}