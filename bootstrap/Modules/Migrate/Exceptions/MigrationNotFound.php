<?php

namespace Bootstrap\Modules\Migrate\Exceptions;

use Exception;

class MigrationNotFound extends Exception
{
    public function __construct(string $message = 'Migration ​​not found', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
