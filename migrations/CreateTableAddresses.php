<?php

namespace Migrations;

use Bootstrap\Contracts\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTableAddresses implements Migration
{
    public function up(): void
    {
        Capsule::schema()->create('addresses', function ($table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('street');
            $table->string('number', 10);
            $table->string('complement')->nullable();
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state', 2);
            $table->string('zip', 8);
            $table->string('country')->default('Brasil');
            $table->timestamps();
        });
    }

    public function down(): void
    {

    }
};
