<?php

use App\Controllers\StatusController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

define('DOCROOT', dirname(__DIR__));

require DOCROOT . '/vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$app->get('/', function (Request $request, Response $response, array $args) {
    return $response->getBody()->write('Hello world, from PHP!');
});

$app->get('/health', StatusController::class . ":getHealth");
$app->get('/ready', StatusController::class . ":getReady");

$app->run();
