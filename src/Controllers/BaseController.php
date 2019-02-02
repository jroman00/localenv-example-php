<?php

namespace App\Controllers;

use Slim\Container;

class BaseController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Container $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
