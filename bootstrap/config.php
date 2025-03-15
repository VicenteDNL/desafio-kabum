<?php

namespace Bootstrap;

use Bootstrap\Modules\Guard\Guard;
use Bootstrap\Modules\HandleError\HandleError;
use Bootstrap\Modules\Middleware\Middleware;
use Bootstrap\Modules\Request\Request;
use Bootstrap\Modules\Response\Response;
use Bootstrap\Modules\Routing\Routing;

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
    'guard'  => [
        'module'  => Guard::class,
        'stacker' => __DIR__ . '/../config/guard.php',
    ],
    'routing'  => [
        'module'      => Routing::class,
        'routes'      => __DIR__ . '/../config/router.php',
    ],
];
