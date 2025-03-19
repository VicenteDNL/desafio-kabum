<?php

namespace Bootstrap\Modules\Guardian;

use Bootstrap\Contracts\Guard;
use Bootstrap\Contracts\Guardian as ContractsGuardian;
use Bootstrap\Contracts\Request;
use Bootstrap\Contracts\Route;
use Bootstrap\Modules\Guardian\Exceptions\GuardAliaseNotFoud;
use Bootstrap\Modules\Guardian\Exceptions\GuardIsNotInstance;
use Bootstrap\Modules\Guardian\Exceptions\GuardProtectedRoute;

class Guardian implements ContractsGuardian
{
    private static Guardian $instance;
    private array $guards = [];

    private function __construct(string $guards)
    {
        $this->guards = require $guards;
    }

    public static function init(string $guards): Guardian
    {

        if (!isset(self::$instance)) {
            self::$instance = new Guardian($guards);
        }

        return self::$instance;
    }

    public function start(Request $request, Route $route): void
    {
        $guards = $route->guards();

        foreach ($guards as $aliase) {

            if(!isset($this->guards[$aliase])) {
                throw new GuardAliaseNotFoud();
            }

            $guard = new $this->guards[$aliase]();

            if(!($guard instanceof Guard)) {
                throw new GuardIsNotInstance();
            }

            $result = $guard->process($request);

            if($result) {
                continue;
            }

            throw new GuardProtectedRoute();

        }

    }
}
