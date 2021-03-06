<?php

namespace Jhmilan\StatsCollector\Services;

use Domnikl\Statsd\Client;

class StatsD
{
    /**
     * The statsd client. See https://github.com/domnikl/statsd-php
     *
     * @var Domnikl\Statsd\Client
     */
    protected $client;

    /**
     * allowed environments
     *
     * @var array
     */
    protected $environments;

    /**
     * allowed methods
     *
     * @var array
     */
    protected $methods;

    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        if (strtolower(config('statscollector.mode')) == 'tcp') {
            $socketClass = "\\Domnikl\\Statsd\\Connection\\TcpSocket";
        } else {
            $socketClass = "\\Domnikl\\Statsd\\Connection\\UdpSocket";
        }

        $connection = new $socketClass(config('statscollector.host'), config('statscollector.port'));

        $this->client = new Client($connection, config('statscollector.ns'));

        if (config('statscollector.ns-prefix')) {
            $this->client->setNamespace(config('statscollector.ns-prefix'));
        }

        $envs = explode(',', config('statscollector.environments'));
        $this->environments = array_map('trim', $envs);
        $this->methods = [
            'increment',
            'decrement',
            'count',
            'timing',
            'time',
            'startTiming',
            'endTiming',
            'memory',
            'startMemoryProfile',
            'endMemoryProfile',
            'gauge',
            'set',
        ];
    }

    /**
     * Magic method to check any action before
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return method call
     */
    public function __call($method, $parameters)
    {
        //just allow some methods and some environments
        if (in_array($method, $this->methods) && in_array(app()->environment(), $this->environments)) {
            return call_user_func_array(array($this, $method), $parameters);
        }
    }

    /**
     * Increment metric key
     *
     * @param string $key Something like: 'foo.bar'
     */
    private function increment($key)
    {
        $this->client->increment($key);
    }

    /**
     * Decrement metric key
     *
     * @param string $key Something like: 'foo.bar'
     */
    private function decrement($key)
    {
        $this->client->decrement($key);
    }

    /**
     * Timing metric
     *
     * @param string $key   Something like: 'foo.bar'
     * @param int    $value Something like: 320
     */
    private function count($key, $value)
    {
        $this->client->count($key, $value);
    }

    /**
     * Timing metric
     *
     * @param string $key   Something like: 'foo.bar'
     * @param int    $value Something like: 320
     */
    private function timing($key, $value)
    {
        $this->client->timing($key, $value);
    }

    /**
     * Time metric
     *
     * @param string  $key     Something like: 'foo.bar'
     * @param Closure $closure Something like: function ( ) { ... }
     */
    private function time($key, $closure)
    {
        $this->client->time($key, $closure);
    }

    /**
     * Starts a timer
     *
     * @param string $key Something like: 'foo.bar'
     */
    private function startTiming($key)
    {
        $this->client->startTiming($key);
    }

    /**
     * Ends a timer
     *
     * @param string $key Something like: 'foo.bar'
     */
    private function endTiming($key)
    {
        $this->client->endTiming($key);
    }

    /**
     * Memory peak metric
     *
     * @param string $key Something like: 'foo.bar'
     */
    private function memory($key)
    {
        $this->client->memory($key);
    }

    /**
     * Starts a memory profile meassure
     *
     * @param string $key Something like: 'foo.bar'
     */
    private function startMemoryProfile($key)
    {
        $this->client->startMemoryProfile($key);
    }

    /**
     * Ends a timer
     *
     * @param string $key Something like: 'foo.bar'
     */
    private function endMemoryProfile($key)
    {
        $this->client->endMemoryProfile($key);
    }

    /**
     * Gauge metric
     *
     * @param string $key   Something like: 'foo.bar'
     * @param mixed  $value Absolute values, e.g.: 3, or delta values e.g.: '-11', '+14'
     */
    private function gauge($key, $value)
    {
        $this->client->gauge($key, $value);
    }

    /**
     * Set metric
     *
     * @param string $key   Something like: 'userId'
     * @param mixed  $value 1234
     */
    private function set($key, $value)
    {
        $this->client->set($key, $value);
    }
}
