<?php

namespace Bootstrap\Modules\HandleError;

use Bootstrap\Contracts\HandleError as ContractsHandleError;
use Bootstrap\Contracts\Request;
use Bootstrap\Contracts\Response as ContractsResponse;
use Bootstrap\Modules\HandleError\Resources\TemplateHTML;
use Bootstrap\Modules\HandleError\Resources\TemplateJson;
use Bootstrap\Modules\Response\Response;
use Throwable;

class HandleError implements ContractsHandleError
{
    private static HandleError $instance;
    private array $messages = [];

    private function __construct(string $messages)
    {
        $this->messages = require $messages;
    }

    public static function init(string $messages): HandleError
    {

        if (!isset(self::$instance)) {
            self::$instance = new HandleError($messages);
        }

        return self::$instance;
    }

    public function treat(Request $request, Throwable $e): ContractsResponse
    {

        $human = isset($this->messages[$e::class])
        ? $this->messages[$e::class]['human']
        : $e->getMessage();

        $system = isset($this->messages[$e::class])
        ? $this->messages[$e::class]['system']
        : $e->getMessage();

        if($request->getHttpAccept() == 'application/json') {

            $result = (new TemplateJson(
                $human,
                $system,
                $_ENV['APP_DEBUG'] == 'true',
                $e
            ))->json();

        } else {

            $result = (new TemplateHTML(
                $human,
                $system,
                $e,
                $_ENV['APP_DEBUG'] == 'true'
            ))->html();
        }
        return new Response(
            $result,
            $request->getHttpAccept(),
            is_numeric($e->getCode()) ? $e->getCode() : 500
        );
    }
}
