<?php


namespace Lib\Middleware;

interface MiddlewareInterface
{
    public function __construct();

    public function handle();
}