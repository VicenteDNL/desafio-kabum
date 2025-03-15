<?php

namespace Bootstrap\Modules\Routing\Exceptions;

use Exception;

class RouterControllerIsNotInstance extends Exception
{
    public function __construct(string $message = 'The controller class does not implement the Controller interface', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
