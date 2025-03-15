<?php

namespace Bootstrap\Modules\Controller;

use Bootstrap\Contracts\Controller as ContractsController;
use Bootstrap\Contracts\Request;

class Controller implements ContractsController
{
    protected Request $request;

    public function __construct(Request $resquest)
    {
        $this->request = $resquest;
    }
}
