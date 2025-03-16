<?php

use Bootstrap\Modules\Database\Database;
use Bootstrap\Modules\Migrate\Migrate;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$dataBase = Database::init();
$migrate = new Migrate(__DIR__ . '/../config/migrations.php');
$migrate->run();
