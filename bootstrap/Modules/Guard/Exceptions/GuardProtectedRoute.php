<?php

namespace Bootstrap\Modules\Guard\Exceptions;

use Exception;

class GuardProtectedRoute extends Exception
{
    public function __construct(string $message = 'Protected route', int $code = 403)
    {
        parent::__construct($message, $code);
    }
}
