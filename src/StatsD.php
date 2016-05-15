<?php

namespace Jhmilan\StatsCollector;

use Domnikl\Statsd\Client;
use Domnikl\Statsd\Connection\UdpSocket;
use Domnikl\Statsd\Connection\TcpSocket;

class StatsD
{
    /**
     * The statsd client. See https://github.com/domnikl/statsd-php
     *
     * @var Domnikl\Statsd\Client
     */
    protected $client;

    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        $socketClass = strtolower(config('statscollector.mode')) == 'tcp' ? 'TcpSocket' : 'UdpSocket';
        $connection = new $socketClass(config('statscollector.host'), config('statscollector.port'));
        $this->client = new Client($connection, config('statscollector.ns'));

        if (config('statscollector.ns-prefix')) {
            $this->client->setNamespace(config('statscollector.ns-prefix'));
        }
    }

    /**
     * Increment metric key
     *
     * @param string $key Something like: 'foo.bar'
     */
    public function increment($key)
    {
        $this->client->increment($key);
    }

    /**
     * Decrement metric key
     *
     * @param string $key Something like: 'foo.bar'
     */
    public function decrement($key)
    {
        $this->client->decrement($key);
    }

    /**
     * Timing metric
     *
     * @param string $key   Something like: 'foo.bar'
     * @param int    $value Something like: 320
     */
    public function count($key, $value)
    {
        $this->client->count($key, $value);
    }

    /**
     * Timing metric
     *
     * @param string $key   Something like: 'foo.bar'
     * @param int    $value Something like: 320
     */
    public function timing($key, $value)
    {
        $this->client->timing($key, $value);
    }

    /**
     * Time metric
     *
     * @param string  $key     Something like: 'foo.bar'
     * @param Closure $closure Something like: function ( ) { ... }
     */
    public function time($key, $closure)
    {
        $this->client->time($key, $closure);
    }

    /**
     * Starts a timer
     *
     * @param string $key Something like: 'foo.bar'
     */
    public function startTiming($key)
    {
        $this->client->startTiming($key);
    }

    /**
     * Ends a timer
     *
     * @param string $key Something like: 'foo.bar'
     */
    public function endTiming($key)
    {
        $this->client->endTiming($key);
    }

    /**
     * Memory peak metric
     *
     * @param string $key Something like: 'foo.bar'
     */
    public function memory($key)
    {
        $this->client->memory($key);
    }

    /**
     * Starts a memory profile meassure
     *
     * @param string $key Something like: 'foo.bar'
     */
    public function startMemoryProfile($key)
    {
        $this->client->startMemoryProfile($key);
    }

    /**
     * Ends a timer
     *
     * @param string $key Something like: 'foo.bar'
     */
    public function endMemoryProfile($key)
    {
        $this->client->endMemoryProfile($key);
    }

    /**
     * Gauge metric
     *
     * @param string $key   Something like: 'foo.bar'
     * @param mixed  $value Absolute values, e.g.: 3, or delta values e.g.: '-11', '+14'
     */
    public function gauge($key, $value)
    {
        $this->client->gauge($key, $value);
    }

    /**
     * Set metric
     *
     * @param string $key   Something like: 'userId'
     * @param mixed  $value 1234
     */
    public function set($key, $value)
    {
        $this->client->set($key, $value);
    }
}
