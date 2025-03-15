<?php

namespace  Bootstrap\Modules\Routing\Resources;

use Bootstrap\Contracts\Router as ContractsRouter;

class Router implements ContractsRouter
{
    private string $method;
    private string $path;
    private string $controller;
    private string $action;

    public function __construct(string $method, string $path, string $controller, string $action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function controller(): string
    {
        return $this->controller;
    }

    public function action(): string
    {
        return $this->action;
    }
}
