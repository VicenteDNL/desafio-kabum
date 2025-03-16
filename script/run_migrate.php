<?php

use Bootstrap\Modules\Database\Database;
use Bootstrap\Modules\Migrate\Migrate;

require __DIR__ . '/../vendor/autoload.php';

$dataBase = Database::init();
$migrate = new Migrate(__DIR__ . '/../config/migrations.php');
$migrate->run();
