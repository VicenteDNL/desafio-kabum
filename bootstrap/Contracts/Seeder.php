<?php

namespace Bootstrap\Contracts;

interface Seeder
{
    /**
     * Run the insert script
     */
    public function run(): void;
}
