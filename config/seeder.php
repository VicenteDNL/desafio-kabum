<?php

use Seeders\AddressSeeder;
use Seeders\ClientSeeder;
use Seeders\UserSeeder;

/**
 *
 * Database seeder recorder, for the seeder script to
 * execute your seeder it is necessary to register it here.
 * The execution is done according to the provisions in this list
 *
 */

return[
    UserSeeder::class,
    ClientSeeder::class,
    AddressSeeder::class,
];
