<?php

namespace Bootstrap\Modules\Seeder\Exceptions;

use Exception;

class SeederNotFound extends Exception
{
    public function __construct(string $message = 'Seeder not found', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
