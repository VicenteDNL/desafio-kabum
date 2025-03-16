<?php

namespace Bootstrap\Contracts;

interface Guard
{
    /**
     * Run the route guard
     *
     * @param Request $request HTTP Request
     */
    public function process(Request $request): bool;
}
