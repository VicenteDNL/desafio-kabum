<?php

namespace Bootstrap\Modules\Request\Exceptions;

use Exception;

class BadRequest extends Exception
{
    public function __construct(string $message = 'Bad Request', int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
