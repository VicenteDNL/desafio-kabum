<?php

use Bootstrap\Modules\Database\Database;
use Bootstrap\Modules\Seeder\Seeder;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$dataBase = Database::init();
$migrate = new Seeder(__DIR__ . '/../config/seeder.php');
$migrate->run();
