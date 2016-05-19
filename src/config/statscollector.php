<?php

return [
    /*
     * The host where StatsD is running
     */
    'host' => env('STATS_COLLECTOR_HOST', '127.0.0.1'),

    /*
     * The port where StatsD is listenning
     */
    'port' => env('STATS_COLLECTOR_PORT', 8125),

    /*
     * A general namespace to idetify any stat sent by StatsCollector
     * Note: this is not a prefix, more or less an agent.
     * You can user something like yourdomain.com.statscollector or 
     * just use the default
     */
    'ns' => env('STATS_COLLECTOR_NS', 'statscollector'),

    /*
     * An (optional) prefix to add to any stat sent by StatsCollector. If you are
     * using 1 single graphite server to show stats from several projects then use
     * this prefix to isolate your stats. For www.example.com you could use:
     *      example
     * or   example.com
     * or   example.local
     * or   example.production
     * or   ... whatever that fits better your requirements
     */
    'ns-prefix' => env('STATS_COLLECTOR_NS_PREFIX'),

    /*
     * Socket mode: [udp|tcp]
     * By default udp, you can use tcp, though. TCP is only recommended for testing
     * purpose during development or just to debug client-server communication.
     * 
     * UDP is in almost all the scenarios the way to go. 
     */
    'mode' => env('STATS_COLLECTOR_MODE', 'udp'),

    /*
     * Maybe you don't want to send stats while PHPUnit is running, just don't include
     * 'testing' in the allowed enviroments. This is a comma-sepparated list 
     */
    'environments' => env('STATS_COLLECTOR_ALLOW_ENVS', 'local, staging, production'),

    /*
     * This package includes a Middleware that can be added to a middleware group or just to a
     * single route. Here you can enable disable what to collect for each request. Each request
     * will update its particular request stats (based on request->path() querystring ignored) and
     * "all requests" information
     */
    'auto-collect' => [
        'num-requests' => env('STATS_COLLECTOR_NUM_REQUESTS', true),
        'request-time' => env('STATS_COLLECTOR_REQUEST_TIME', true),
        'memory-profile' => env('STATS_COLLECTOR_MEMORY_PROFILE', true),
        //heads up! when this flag is active the middleware will run
        //DB::enableQueryLog();
        //You might not want to enable db profiling in production environment or just
        //enable this temporarily. Keep this in mind in terms of performance 
        'db-profile' => env('STATS_COLLECTOR_DB_PROFILE', true),
    ],
];