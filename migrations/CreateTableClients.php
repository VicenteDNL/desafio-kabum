<?php

namespace Migrations;

use Bootstrap\Contracts\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTableClients implements Migration
{
    public function up(): void
    {
        Capsule::schema()->create('clients', function ($table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('document', 11);
            $table->string('general_registration', 11);
            $table->string('phone_number', 11);
            $table->timestamps();
        });
    }

    public function down(): void
    {

    }
};
