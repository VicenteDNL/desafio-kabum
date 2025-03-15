<?php

namespace Bootstrap;

use Bootstrap\Contracts\Request;
use Bootstrap\Contracts\Response;
use Bootstrap\Contracts\Routing;
use Bootstrap\Modules\Response\Response as ResponseResponse;
use Exception;

class Application
{
    private static Application $instance;
    private Request $request;
    private Routing $routing;
    private array $config;

    private function __construct()
    {
        $this->config = require __DIR__ . '/config.php';

        $this->initRequest();
        $this->initRouting();

    }

    public static function init()
    {

        if (!isset(self::$instance)) {
            self::$instance = new Application();
        }

        return self::$instance;
    }

    public function dispath(): Response
    {
        $route = $this->routing->getRoute($this->request->getMethod(), $this->request->getPath());
        $controller = new ($route->controller())($this->request);
        $action = $route->action();
        $result = $controller->$action();

        return new ResponseResponse();

    }

    private function initRequest(): void
    {
        if(!class_exists($this->config['request'])) {
            throw new Exception('config["request"] not configured');
        }

        $request = $this->config['request']::init();

        if(!($request instanceof Request)) {
            throw new Exception('config["request"] is not instanceof ' . Request::class);
        }

        $this->request = $request ;
    }

    private function initRouting(): void
    {
        if(!class_exists($this->config['routing']['module'])) {
            throw new Exception('config["routing"] not configured');
        }

        $routing = $this->config['routing']['module']::init($this->config['routing']['routes']);

        if(!($routing instanceof Routing)) {
            throw new Exception('config["routing"]["module"] is not instanceof ' . Routing::class);
        }

        $this->routing = $routing ;
    }
}

return Application::init();
