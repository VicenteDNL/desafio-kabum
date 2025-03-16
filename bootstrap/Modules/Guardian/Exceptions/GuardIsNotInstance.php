<?php

namespace Bootstrap\Modules\Guardian\Exceptions;

use Exception;

class GuardIsNotInstance extends Exception
{
    public function __construct(string $message = 'The guard class does not implement the Guard interface', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
