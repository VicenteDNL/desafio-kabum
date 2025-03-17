<?php

namespace App\Middlewares;

use Closure;

class ExampleMiddleware
{
    public static function process(Closure $next)
    {

        $response = $next();

        return $response;

    }
}
