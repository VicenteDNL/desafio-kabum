<?php

namespace Bootstrap\Contracts;

interface Migration
{
    /**
     * Executes the statement in the database
     */
    public function up(): void;

    /**
     * Undo the change in the database
     */
    public function down(): void;
}
