<?php

namespace Bootstrap\Modules\Guardian\Exceptions;

use Exception;

class GuardAliaseNotFoud extends Exception
{
    public function __construct(string $message = 'Guard Alias ​​not found', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
