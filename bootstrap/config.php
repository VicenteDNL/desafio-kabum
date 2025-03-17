<?php

namespace Bootstrap;

use Bootstrap\Modules\Guardian\Guardian;
use Bootstrap\Modules\HandleError\HandleError;
use Bootstrap\Modules\Middleware\Middleware;
use Bootstrap\Modules\Request\Request;
use Bootstrap\Modules\Response\Response;
use Bootstrap\Modules\Routing\Routing;

/**
 * File to register application modules
 */
return [
    'request'     => Request::class,
    'response'    => Response::class,
    'handleError' => [
        'module'   => HandleError::class,
        'messages' => __DIR__ . '/../config/error.php',
    ],

    'middleware'  => [
        'module'  => Middleware::class,
        'stacker' => __DIR__ . '/../config/middleware.php',
    ],
    'guardian'  => [
        'module'  => Guardian::class,
        'guards'  => __DIR__ . '/../config/guard.php',
    ],
    'routing'  => [
        'module'      => Routing::class,
        'routes'      => __DIR__ . '/../config/router.php',
    ],
];
