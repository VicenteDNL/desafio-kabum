<?php

namespace  Bootstrap\Modules\Routing\Resources;

use Bootstrap\Contracts\Route as ContractsRoute;

class Route implements ContractsRoute
{
    private string $method;
    private string $path;
    private string $controller;
    private string $action;
    private array $guards;

    public function __construct(string $method, string $path, string $controller, string $action, array $guards = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->guards = $guards;
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

    public function guards(): array
    {
        return $this->guards;
    }
}
