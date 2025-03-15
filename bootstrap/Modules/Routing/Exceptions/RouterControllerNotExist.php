<?php

namespace Bootstrap\Modules\Routing\Exceptions;

use Exception;

class RouterControllerNotExist extends Exception
{
    public function __construct(string $message = 'The controller class passed in the route configuration does not exist', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
