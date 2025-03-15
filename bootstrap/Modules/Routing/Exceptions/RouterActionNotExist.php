<?php

namespace Bootstrap\Modules\Routing\Exceptions;

use Exception;

class RouterActionNotExist extends Exception
{
    public function __construct(string $message = 'The  method(action) passed in the route configuration does not exist', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
