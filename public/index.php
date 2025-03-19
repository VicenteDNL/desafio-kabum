<?php

header('Access-Control-Allow-Origin: http://localhost:3000');

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->dispatch();
