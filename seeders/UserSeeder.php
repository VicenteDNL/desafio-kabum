<?php

namespace Seeders;

use Bootstrap\Contracts\Seeder;
use Faker\Factory;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserSeeder implements Seeder
{
    public function run(): void
    {
        $faker = Factory::create('pt_BR');

        for ($i = 0; $i < 5; ++$i) {
            Capsule::table('users')->insert([
                'name'                 => $faker->name,
                'email'                => 'user' . $i . '@example.com',
                'password'             => password_hash('1234', PASSWORD_BCRYPT),
                'created_at'           => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
