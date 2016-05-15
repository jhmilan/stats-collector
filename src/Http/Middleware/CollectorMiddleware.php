<?php

namespace Jhmilan\StatsCollector\Http\Middleware;

use DB;
use Closure;
use StatsCollector;

class CollectorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = str_replace('/', '.', $request->path());

        if (config('statscollector.auto-collect.request-time')) {
            StatsCollector::startTiming($key);
        }

        if (config('statscollector.auto-collect.db-profile')) {
            StatsCollector::startMemoryProfile($key);
        }

        if (config('statscollector.auto-collect.db-profile')) {
            DB::enableQueryLog();
        }

        $response = $next($request);

        if (config('statscollector.auto-collect.request-time')) {
            StatsCollector::endTiming($key);
        }

        if (config('statscollector.auto-collect.memory-profile')) {
            StatsCollector::endMemoryProfile($key);
        }

        if (config('statscollector.auto-collect.db-profile')) {
            StatsCollector::count($key.'.num-queries', count(DB::getQueryLog()));
        }

        return $response;
    }
}
