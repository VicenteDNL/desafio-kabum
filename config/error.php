<?php

use Bootstrap\Modules\Guardian\Exceptions\GuardAliaseNotFoud;
use Bootstrap\Modules\Guardian\Exceptions\GuardIsNotInstance;
use Bootstrap\Modules\Guardian\Exceptions\GuardProtectedRoute;
use Bootstrap\Modules\Request\Exceptions\BadRequest;
use Bootstrap\Modules\Routing\Exceptions\RouteNotFound;
use Bootstrap\Modules\Routing\Exceptions\RouterActionNotExist;
use Bootstrap\Modules\Routing\Exceptions\RouterControllerIsNotInstance;
use Bootstrap\Modules\Routing\Exceptions\RouterControllerNotExist;

/**
 *
 * Exception message customizer
 *
 */
return[
    BadRequest::class => [
        'human'  => '',
        'system' => '',
    ],
    GuardProtectedRoute::class => [
        'human'  => '',
        'system' => '',
    ],
    GuardAliaseNotFoud::class => [
        'human'  => '',
        'system' => '',
    ],
    GuardIsNotInstance::class => [
        'human'  => '',
        'system' => '',
    ],
    RouteNotFound::class => [
        'human'  => '',
        'system' => '',
    ],
    RouterActionNotExist::class => [
        'human'  => '',
        'system' => '',
    ],
    RouterControllerIsNotInstance::class => [
        'human'  => '',
        'system' => '',
    ],
    RouterControllerNotExist::class => [
        'human'  => '',
        'system' => '',
    ],
];
