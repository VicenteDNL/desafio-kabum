<?php

namespace Bootstrap\Modules\Seeder;

use Bootstrap\Contracts\Seeder as ContractsSeeder;
use Bootstrap\Modules\Seeder\Exceptions\SeederIsNotInstance;
use Bootstrap\Modules\Seeder\Exceptions\SeederNotFound;

class Seeder
{
    private array $seeders;

    public function __construct($seeders)
    {
        $this->seeders = require $seeders;
    }

    public function run()
    {
        foreach ($this->seeders as $seeder) {

            if(!class_exists($seeder)) {
                throw new SeederNotFound();
            }
            $seeder = new $seeder();

            if(!($seeder instanceof ContractsSeeder)) {
                throw new SeederIsNotInstance();
            }

            $seeder->run();
        }
    }
}
