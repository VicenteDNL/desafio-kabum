<?php

namespace Seeders;

use Bootstrap\Contracts\Seeder;
use Faker\Factory;
use Illuminate\Database\Capsule\Manager as Capsule;

class ClientsSeeder implements Seeder
{
    public function run(): void
    {
        $faker = Factory::create('pt_BR');

        for ($i = 0; $i < 10; ++$i) {
            Capsule::table('clients')->insert([
                'name'                 => $faker->name,
                'date_of_birth'        => $faker->date('Y-m-d', '2000-12-31'),
                'document'             => $faker->cpf(false),
                'general_registration' => $faker->rg(false),
                'phone_number'         => $faker->cellphoneNumber(false),
                'created_at'           => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
