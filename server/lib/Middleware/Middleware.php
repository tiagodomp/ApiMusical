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

    public $use;

    /**
     * Middleware constructor.
     * @param mixed ...$params
     */
    public function __construct(...$params)
    {

    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

    }
}