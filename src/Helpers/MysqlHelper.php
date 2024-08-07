<?php

namespace App\Helpers;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Exception;

class MysqlHelper
{
    /**
     * @var static
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
                'host' => getenv('APP_MYSQL_HOST', true),
                'port' => getenv('APP_MYSQL_PORT', true),
                'user' => getenv('APP_MYSQL_USER', true),
                'password' => getenv('APP_MYSQL_PASSWORD', true),
                'dbname' => getenv('APP_MYSQL_DATABASE', true),
                'driver' => 'pdo_mysql',
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
