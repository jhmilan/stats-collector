<?php

namespace Jhmilan\StatsCollector\Facades;

use Illuminate\Support\Facades\Facade;

class StatsCollector extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'statscollector';
    }
}
