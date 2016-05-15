<?php

return [
    'host' => env('STATS_COLLECTOR_HOST', '127.0.0.1'),
    'port' => env('STATS_COLLECTOR_PORT', 8125),
    'ns' => env('STATS_COLLECTOR_NS', 'myapp.namespace'),
    'ns-prefix' => env('STATS_COLLECTOR_NS_PREFIX'),
    'mode' => env('STATS_COLLECTOR_MODE', 'udp'),

    'auto-collect' => [
        'request-time' => true,
        'memory-profile' => true,
        //heads up! Production environment: it will enable query log in middleware!
        'db-profile' => true,
    ],
];