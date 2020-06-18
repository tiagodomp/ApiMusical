<?php


namespace Lib\Middleware;

use Closure;
use Lib\Http\Request;

abstract class Middleware
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
    public function __construct($type, $namesMidd)
    {
        $middlewares = require_once config_path('middleware.php')?:[];

        if(!empty($middlewares[$type])){
            $this->middlewares = $middlewares[$type];

            foreach ((array)$namesMidd as $name)
                if (isset($this->middlewares[$name]))
                    $this->use[$name] = $this->middlewares[$name];
        }
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle()
    {
        $data = $this->use;
        foreach ( $data as $name => $class )
            if(method_exists($class, 'handle')) {
                $interface = $this->getInterface($class);
                $this->use[$name] = (new $class($interface))->handle();
            }
    }

    private function getInterface($class)
    {
        $interface = $class . 'Interface';
        if (is_callable($interface))
            return $interface;
    }
}