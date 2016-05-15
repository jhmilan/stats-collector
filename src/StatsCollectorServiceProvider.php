<?php

namespace Jhmilan\StatsCollector;

use Jhmilan\StatsCollector\StatsD;
use Illuminate\Support\ServiceProvider;

class StatsCollectorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        $this->app->singleton(StatsD::class, function ($app) {
            return new StatsD();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [StatsD::class];
    }
}