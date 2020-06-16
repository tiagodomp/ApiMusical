<?php


namespace App\Http\Middleware;

use Closure;
use Lib\Http\Request;
use Lib\Middleware\Middleware;

class Auth extends Middleware
{
    public function __construct(...$params)
    {
        parent::__construct($params);
    }

    public function handle(Request $request, Closure $next)
    {

    }

}