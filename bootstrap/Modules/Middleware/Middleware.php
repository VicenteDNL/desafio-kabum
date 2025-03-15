<?php

namespace Bootstrap\Modules\Middleware;

use Bootstrap\Contracts\Middleware as ContractsMiddleware;
use Bootstrap\Contracts\Request;
use Closure;

class Middleware implements ContractsMiddleware
{
    private static Middleware $instance;
    private array $middlewares = [];
    private int $index = 0;
    private Closure $handle;

    private function __construct(string $stacker)
    {
        $this->middlewares = require $stacker;
    }

    public static function init(string $stacker): Middleware
    {

        if (!isset(self::$instance)) {
            self::$instance = new Middleware($stacker);
        }

        return self::$instance;
    }

    public function start(Request $request, Closure $handle)
    {
        $this->handle = $handle;
        $this->index = 0;
        return $this->next($request);
    }

    private function next(Request $request)
    {
        if (isset($this->middlewares[$this->index])) {

            $execute = $this->middlewares[$this->index];
            ++$this->index;

            return $execute::process(
                function () use ($request) {
                    return $this->next($request);
                }
            );
        }

        return $this->handle->call($this);
    }
}
