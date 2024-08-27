<?php

namespace App\Controllers;

use App\Helpers\MysqlHelper;
use App\Helpers\PostgresHelper;
use App\Helpers\RedisHelper;
use Slim\Http\Request;
use Slim\Http\Response;

class StatusController extends BaseController
{
    /**
     * @var string
     */
    public const STATUS_OK = 'ok';

    /**
     * @var string
     */
    public const STATUS_ERROR = 'error';

    /**
     * @return MysqlHelper
     */
    private function getMysqlHelper(): MysqlHelper
    {
        return MysqlHelper::getInstance();
    }

    /**
     * @return PostgresHelper
     */
    private function getPostgresHelper(): PostgresHelper
    {
        return PostgresHelper::getInstance();
    }

    /**
     * @return RedisHelper
     */
    private function getRedisHelper(): RedisHelper
    {
        return RedisHelper::getInstance();
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getHealth(Request $request, Response $response, array $args): Response
    {
        return $response->withJson([
            'service' => static::STATUS_OK,
            'version' => getenv('APP_VERSION'),
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getReady(Request $request, Response $response, array $args): Response
    {
        $mysqlIsReady = $this->getMysqlHelper()->isReady();
        $postgresIsReady = $this->getPostgresHelper()->isReady();
        $redisIsReady = $this->getRedisHelper()->isReady();

        $status = 200;
        if (!$mysqlIsReady || !$postgresIsReady || !$redisIsReady) {
            $status = 500;
        }

        return $response->withJson([
            'service' => static::STATUS_OK,
            'version' => getenv('APP_VERSION'),
            'mysql' => $mysqlIsReady ? static::STATUS_OK : static::STATUS_ERROR,
            'postgres' => $postgresIsReady ? static::STATUS_OK : static::STATUS_ERROR,
            'redis' => $redisIsReady ? static::STATUS_OK : static::STATUS_ERROR,
        ], $status);
    }
}
