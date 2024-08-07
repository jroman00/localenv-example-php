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
        $mysql = $this->getMysqlHelper();
        $postgres = $this->getPostgresHelper();
        $redis = $this->getRedisHelper();

        return $response->withJson([
            'service' => static::STATUS_OK,
            'mysql' => $mysql->isReady() ? static::STATUS_OK : static::STATUS_ERROR,
            'postgres' => $postgres->isReady() ? static::STATUS_OK : static::STATUS_ERROR,
            'redis' => $redis->isReady() ? static::STATUS_OK : static::STATUS_ERROR,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getVersion(Request $request, Response $response, array $args): Response
    {
        return $response->withJson([
            'service' => static::STATUS_OK,
            'version' => getenv('APP_VERSION'),
        ]);
    }
}
