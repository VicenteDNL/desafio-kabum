<?php

namespace Bootstrap\Modules\Migrate\Exceptions;

use Exception;

class MigrationIsNotInstance extends Exception
{
    public function __construct(string $message = 'The migration class does not implement the Migration interface', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
