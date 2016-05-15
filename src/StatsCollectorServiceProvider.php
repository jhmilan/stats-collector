<?php

namespace Jhmilan\StatsCollector;

use Jhmilan\StatsCollector\Services\StatsD;
use Illuminate\Support\ServiceProvider;

class StatsCollectorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/statscollector.php' => config_path('statscollector.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('statscollector', function ($app) {
            return new StatsD();
        });
    }
}