<?php

namespace Bootstrap\Modules\Routing\Exceptions;

use Exception;

class RouteNotFound extends Exception
{
    public function __construct(string $message = 'Route not found', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
