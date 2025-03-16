<?php

namespace Bootstrap\Modules\Database;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class Database
{
    private static Database $instance;
    private Capsule $capsule ;

    private function __construct()
    {
        $capsule = new Capsule();

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'desafio-db',
            'database'  => 'desafio',
            'username'  => 'desafio',
            'password'  => 'desafio',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setEventDispatcher(new Dispatcher(new Container()));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public static function init(): Database
    {

        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }

        return self::$instance;
    }
}
