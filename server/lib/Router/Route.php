<?php

namespace Lib\Router;

final class Route
{

    /**
     *  Http Method.
     *
     * @var string
     */
    private $method;

    /**
     *  The path for this route.
     *
     *  @var string
     */
    private $pattern;

    /**
     * The action, controller, callable. this route points to.
     *
     * @var mixed
     */
    private $callback;

    /**
     *  Allows these HTTP methods.
     *
     *  @var array
     */
    private $list_method = ['GET', 'POST', 'PUT', 'DELETE', 'OPTION'];

    /**
     * middlewares of route
     *
     * @var array
     */
    private $middleware;

    /**
     *  construct function
     */
    public function __construct($method, $pattern, $callback) {
        $this->method = $this->validateMethod(strtoupper($method));
        $this->pattern = cleanUrl($pattern);
        $this->callback = (string) $callback;
    }

    /**
     *  check valid method
     */
    private function validateMethod($method) {
        if (in_array(strtoupper($method), $this->list_method))
            return (string) $method;

        throw new \Exception('Método inválido');
    }

    /**
     *  get method
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     *  get pattern
     */
    public function getPattern() {
        return $this->pattern;
    }

    /**
     *  get callback
     */
    public function getCallback() {
        return $this->callback;
    }

    /**
     * define the middleware of route
     */
    public function setMiddleware($name, $class) {
        if(is_callable($class))
            $this->middleware[$name] = $class;
    }
}