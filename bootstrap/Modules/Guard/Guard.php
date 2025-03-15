<?php

namespace Bootstrap\Modules\Guard;

use Bootstrap\Contracts\Guard as ContractsGuard;
use Bootstrap\Contracts\Request;
use Bootstrap\Contracts\Route;
use Bootstrap\Modules\Guard\Exceptions\GuardAliaseNotFoud;
use Bootstrap\Modules\Guard\Exceptions\GuardProtectedRoute;

class Guard implements ContractsGuard
{
    private static Guard $instance;
    private array $guard = [];

    private function __construct(string $stacker)
    {
        $this->guard = require $stacker;
    }

    public static function init(string $stacker): Guard
    {

        if (!isset(self::$instance)) {
            self::$instance = new Guard($stacker);
        }

        return self::$instance;
    }

    public function start(Request $request, Route $route): void
    {
        $guards = $route->guards();

        if(empty($guards)) {
            return;
        }

        foreach ($guards as $aliase) {

            if(!isset($this->guard[$aliase])) {
                throw new GuardAliaseNotFoud();
            }

            $result = $this->guard[$aliase]::process($request);

            if($result) {
                continue;
            }

            throw new GuardProtectedRoute();

        }

    }
}
