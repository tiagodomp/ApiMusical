<?php

return [
/**
 *
 * Routes Middlewares
 */

    "route" => [
        'auth'  => Lib\Middleware\Auth::class,
        'jwt'   => Lib\Middleware\JWT::class,
        'form'  => Lib\Middleware\FormRequest\FormRequest::class,
    ],

];