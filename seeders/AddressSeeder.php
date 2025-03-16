<?php

namespace Seeders;

use Bootstrap\Contracts\Seeder;
use Faker\Factory;
use Illuminate\Database\Capsule\Manager as Capsule;

class AddressSeeder implements Seeder
{
    public function run(): void
    {
        $faker = Factory::create('pt_BR');
        $clientIds = Capsule::table('clients')->pluck('id')->toArray();

        for ($i = 0; $i < 10; ++$i) {

            Capsule::table('address')->insert([
                'client_id'    => $faker->randomElement($clientIds),
                'street'       => $faker->streetName,
                'number'       => $faker->buildingNumber,
                'complement'   => $faker->secondaryAddress,
                'neighborhood' => $faker->streetSuffix,
                'city'         => $faker->city,
                'state'        => $faker->stateAbbr,
                'zip'          => preg_replace('/[^0-9]/', '', $faker->postcode),
                'country'      => 'Brasil',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
        }

    }
}
