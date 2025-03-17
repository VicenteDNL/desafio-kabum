<?php

use Migrations\CreateTableAddresses;
use Migrations\CreateTableClients;
use Migrations\CreateTableUsers;

/**
 *
 * Database migration recorder, for the migration script to
 * execute your migration it is necessary to register it here.
 * The execution is done according to the provisions in this list
 *
 */
return [
    CreateTableUsers::class,
    CreateTableClients::class,
    CreateTableAddresses::class,
];
