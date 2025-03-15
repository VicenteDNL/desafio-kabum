<?php

namespace Bootstrap\Contracts;

interface Guard
{
    /**
     * Initializes an instance of Guard or retrieves an already initialized instance
     *
     * @param string $stacker location of registered guards
     */
    public static function init(string $stacker): Guard;

    /**
     * Start of the execution flow of registered Guard
     *
     * @param Request $request Request HTTP
     * @param Route   $route   The protected route
     */
    public function start(Request $request, Route $route): void;
}
