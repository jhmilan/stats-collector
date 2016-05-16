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
        $keyRequest = 'requests.'.str_replace('/', '.', $request->path());
        $keyAll = 'requests.all';

        if (config('statscollector.auto-collect.request-time')) {
            StatsCollector::startTiming($keyRequest);
            StatsCollector::startTiming($keyAll);
        }

        if (config('statscollector.auto-collect.memory-profile')) {
            StatsCollector::startMemoryProfile($keyRequest);
            StatsCollector::startMemoryProfile($keyAll);
        }

        if (config('statscollector.auto-collect.db-profile')) {
            DB::enableQueryLog();
        }

        $response = $next($request);

        if (config('statscollector.auto-collect.request-time')) {
            StatsCollector::endTiming($keyRequest);
            StatsCollector::endTiming($keyAll);
        }

        if (config('statscollector.auto-collect.memory-profile')) {
            StatsCollector::endMemoryProfile($keyRequest);
            StatsCollector::endMemoryProfile($keyAll);
        }

        if (config('statscollector.auto-collect.db-profile')) {
            $numQueries = count(DB::getQueryLog());
            StatsCollector::count($keyRequest.'.num-queries', $numQueries);
            StatsCollector::count($keyAll.'.num-queries', $numQueries);
        }

        return $response;
    }
}
