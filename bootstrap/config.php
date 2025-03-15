<?php

namespace Bootstrap;

use Bootstrap\Modules\Middleware\Middleware;
use Bootstrap\Modules\Request\Request;
use Bootstrap\Modules\Response\Response;
use Bootstrap\Modules\Routing\Routing;

return [
    'request'     => Request::class,
    'response'    => Response::class,
    'middleware'  => [
        'module'  => Middleware::class,
        'stacker' => __DIR__ . '/../middleware.php',
    ],
    'routing'  => [
        'module'      => Routing::class,
        'routes'      => __DIR__ . '/../router.php',
    ],
];
