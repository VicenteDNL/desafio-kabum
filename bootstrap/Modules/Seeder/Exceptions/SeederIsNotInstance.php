<?php

namespace Bootstrap\Modules\Seeder\Exceptions;

use Exception;

class SeederIsNotInstance extends Exception
{
    public function __construct(string $message = 'The seeder class does not implement the Seeder interface', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
