<?php

namespace Bootstrap\Contracts;

/**
 * interface Controller
 *
 * class responsible for receiving and processing the request
 */
interface Controller
{
    public function __construct(Request $request);
}
