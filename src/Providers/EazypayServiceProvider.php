<?php

namespace Bhavinjr\Eazypay\Providers;

use Illuminate\Support\ServiceProvider;
use Bhavinjr\Eazypay;

class EazypayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/../../config/eazypay.php' => config_path('eazypay.php')], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $config = __DIR__ . '/../../config/eazypay.php';
        $this->mergeConfigFrom($config, 'eazypay');
        $this->app->singleton('Eazypay', Eazypay::class);
    }
    public function provides()
    {
        // return ['Eazypay'];
    }
}
