<?php

require_once __DIR__.'/../vendor/autoload.php';

require_once '../lib/Helper/globais.php';
require '../config/app.php';
require '../lib/ClassLoader.php';
require_once '../development/swagger.php';


// using
use Lib\Router\Router;

// create object of request and response class
$request = new Lib\Http\Request();
$response = new Lib\Http\Response();

// set request url and method
$router = new Router('/' . $request->getUrl(), $request->getMethod());

// import router file
require '../routes/api.php';

// Router Run Request
$router->run();

date_default_timezone_set('UTC');

// Response Render Content
$response->render();

