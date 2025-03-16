<?php

namespace Migrations;

use Bootstrap\Contracts\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTableUsers implements Migration
{
    public function up(): void
    {
        Capsule::schema()->create('users', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {

    }
};
