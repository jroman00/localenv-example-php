<?php

namespace App\Helpers;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Exception;

class PostgresHelper
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var Connection
     */
    private $client;

    /**
     * @param Connection $client
     */
    public function __construct(Connection $client)
    {
        $this->client = $client;
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (!static::$instance) {
            static::$instance = new static(DriverManager::getConnection([
                'host' => getenv('APP_POSTGRES_HOST', true),
                'port' => getenv('APP_POSTGRES_PORT', true),
                'user' => getenv('APP_POSTGRES_USER', true),
                'password' => getenv('APP_POSTGRES_PASSWORD', true),
                'dbname' => getenv('APP_POSTGRES_DATABASE', true),
                'driver' => 'pdo_pgsql',
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
        try {
            $this->client->executeQuery('SELECT 1');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
