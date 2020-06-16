<?php


namespace Lib\Router;

use \Lib\Middleware\Middleware;

class RouteMiddleware extends Middleware
{
    /**
     * @array \config\middleware
     */
    protected $middlewares;

    /**
     * @array middlewares instancied
     */
    public $use;

    /**
     * RouteMiddleware constructor.
     * @param array $namesMidd
     */
    public function __construct($namesMidd)
    {
        $middlewares = require_once config_path('middleware');

        if(isset($middlewares['route'])) {
            $this->middlewares = $middlewares['route'];

            foreach ((array)$namesMidd as $name)
                if (isset($this->middlewares[$name]))
                    $this->use[$name] = $this->middlewares[$name];
        }
    }
}