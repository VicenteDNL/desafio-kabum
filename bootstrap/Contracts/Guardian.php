<?php

namespace Bootstrap\Contracts;

interface Guardian
{
    /**
     * Initializes an instance of Guard or retrieves an already initialized instance
     *
     * @param string $stacker location of registered guards
     * @param string $guards
     */
    public static function init(string $guards): Guardian;

    /**
     * Start of the execution flow of registered Guard
     *
     * @param Request $request Request HTTP
     * @param Route   $route   The protected route
     */
    public function start(Request $request, Route $route): void;
}
