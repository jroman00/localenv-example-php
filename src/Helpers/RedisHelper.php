<?php

namespace App\Helpers;

use Predis\Client;

class RedisHelper
{
    /**
     * @var static
     */
    private static $instance;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (!static::$instance) {
            static::$instance = new static(new Client([
                'host' => getenv('APP_REDIS_HOST'),
                'port' => getenv('APP_REDIS_PORT'),
            ]));
        }

        return static::$instance;
    }

    /**
     * @param null|self $instance
     * @return void
     */
    public static function setInstance(?self $instance): void
    {
        static::$instance = $instance;
    }

    /**
     * @return bool
     */
    public function isReady(): bool
    {
        return $this->client->ping()->getPayload() === 'PONG';
    }
}
