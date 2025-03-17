<?php

namespace Bootstrap;

use Bootstrap\Contracts\Guardian;
use Bootstrap\Contracts\HandleError;
use Bootstrap\Contracts\Middleware;
use Bootstrap\Contracts\Request;
use Bootstrap\Contracts\Response;
use Bootstrap\Contracts\Routing;
use Bootstrap\Modules\Database\Database;
use Exception;
use Throwable;

/**
 * The core of the application, it is responsible for managing the modules attached to the application
 *
 * @class Application
 */
class Application
{
    private static Application $instance;
    private Request $request;
    private Response $response;
    private Routing $routing;
    private Middleware $middleware;
    private Guardian $guardian;
    private HandleError $handleError;
    private Database $database;
    private array $config;

    private function __construct()
    {
        $this->config = require __DIR__ . '/config.php';

        $this->initRequest();
        $this->initRouting();
        $this->initResponse();
        $this->initMiddleware();
        $this->initGuardian();
        $this->initHandleError();
        $this->initDataBase();

    }

    public static function init()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Application();
        }

        return self::$instance;
    }

    public function dispath(): void
    {
        try {

            $route = $this->routing->find($this->request);

            $this->guardian->start($this->request, $route);

            $controller = new ($route->controller())($this->request);
            $action = $route->action();
            $params = $route->params();
            $handler = function () use ($controller, $action, $params) {
                return $controller->$action(...$params);
            };

            $result = $this->middleware->start($this->request, $handler);

        } catch(Throwable $e) {

            $result = $this->handleError->treat($this->request, $e);
        }

        if(is_object($result) && $result instanceof Response) {

            header('Content-Type: ' . $result->getContentType());
            http_response_code($result->getStatusCode());
            echo $result->getContent();

        } else {
            $this->response->setContent($result);
            header('Content-Type: ' . $this->response->getContentType());
            http_response_code($this->response->getStatusCode());
            echo $this->response->getContent();
        }

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

        $this->request = $request;
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

    private function initResponse(): void
    {
        if(!class_exists($this->config['response'])) {
            throw new Exception('config["response"] not configured');
        }

        $response = new ($this->config['response'])('', $this->request->getHttpAccept(), 200);

        if(!($response instanceof Response)) {
            throw new Exception('config["response"] is not instanceof ' . Response::class);
        }

        $this->response = $response ;
    }

    private function initMiddleware()
    {
        if(!class_exists($this->config['middleware']['module'])) {
            throw new Exception('config["middleware"] not configured');
        }

        $middleware = $this->config['middleware']['module']::init($this->config['middleware']['stacker']);

        if(!($middleware instanceof Middleware)) {
            throw new Exception('config["middleware"]["module"] is not instanceof ' . Middleware::class);
        }

        $this->middleware = $middleware;

    }

    private function initGuardian()
    {
        if(!class_exists($this->config['guardian']['module'])) {
            throw new Exception('config["guardian"] not configured');
        }

        $guardian = $this->config['guardian']['module']::init($this->config['guardian']['guards']);

        if(!($guardian instanceof Guardian)) {
            throw new Exception('config["guardian"]["module"] is not instanceof ' . Guardian::class);
        }

        $this->guardian = $guardian;

    }

    private function initHandleError()
    {
        if(!class_exists($this->config['handleError']['module'])) {
            throw new Exception('config["handleError"]["module"] not configured');
        }

        $handleError = $this->config['handleError']['module']::init($this->config['handleError']['messages']);

        if(!($handleError instanceof HandleError)) {
            throw new Exception('config["handleError"]["module"] is not instanceof ' . HandleError::class);
        }

        $this->handleError = $handleError;

    }

    private function initDataBase()
    {
        $this->database = Database::init();
    }
}

return Application::init();
