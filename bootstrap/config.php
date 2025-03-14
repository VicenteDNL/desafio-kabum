<?php

namespace Bootstrap;

use Bootstrap\Modules\Request\Request;
use Bootstrap\Modules\Routing\Routing;

return [
    'request' => Request::class,
    'routing' => [
        'module'      => Routing::class,
        'routes'      => __DIR__ . '/../router.php',
    ],
];
