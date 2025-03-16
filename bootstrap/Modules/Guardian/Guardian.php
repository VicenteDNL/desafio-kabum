<?php

namespace Bootstrap\Modules\Guardian;

use Bootstrap\Contracts\Guardian as ContractsGuardian;
use Bootstrap\Contracts\Request;
use Bootstrap\Contracts\Route;
use Bootstrap\Modules\Guard\Exceptions\GuardAliaseNotFoud;
use Bootstrap\Modules\Guard\Exceptions\GuardProtectedRoute;

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

        if(empty($guards)) {
            return;
        }

        foreach ($guards as $aliase) {

            if(!isset($this->guards[$aliase])) {
                throw new GuardAliaseNotFoud();
            }

            $result = $this->guards[$aliase]::process($request);

            if($result) {
                continue;
            }

            throw new GuardProtectedRoute();

        }

    }
}
