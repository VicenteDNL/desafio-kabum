<?php

namespace Bootstrap\Modules\Migrate;

use Bootstrap\Contracts\Migration;
use Bootstrap\Modules\Migrate\Exceptions\MigrationIsNotInstance;
use Bootstrap\Modules\Migrate\Exceptions\MigrationNotFound;

class Migrate
{
    private array $migrations;

    public function __construct($migrations)
    {
        $this->migrations = require $migrations;
    }

    public function run()
    {
        foreach ($this->migrations as $migration) {

            if(!class_exists($migration)) {
                throw new MigrationNotFound();
            }
            $migration = new $migration();

            if(!($migration instanceof Migration)) {
                throw new MigrationIsNotInstance();
            }

            $migration->up();

        }

    }

    public function rollback()
    {

        foreach (array_reverse($this->migrations) as $migration) {

            if(!class_exists($migration)) {
                throw new MigrationNotFound();
            }
            $migration = new $migration();

            if(!($migration instanceof Migration)) {
                throw new MigrationIsNotInstance();
            }

            $migration->down();

        }

    }
}
