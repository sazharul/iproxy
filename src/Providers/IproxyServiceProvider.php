<?php

namespace VendorName\Iproxy\Providers;

use Illuminate\Support\ServiceProvider;

class IproxyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/iproxy.php' => config_path('iproxy.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/iproxy.php', 'iproxy'
        );

        $this->app->singleton('iproxy', function ($app) {
            return new \VendorName\Iproxy\Services\IproxyService();
        });
    }
}
