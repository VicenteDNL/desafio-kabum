<?php

namespace App\Controllers;

use Bootstrap\Modules\Controller\Controller;

/**
 * TODO: verifica para que a chamada nao seja feito direto de uma classe do modulo (remover aclopamento)
 */
use Bootstrap\Modules\Response\Response;

class ClientController extends Controller
{
    public function index()
    {

        return Response::json(['status' => 'success', 'data' => 'index']);
    }

    public function show($id)
    {
        var_dump('show');
    }

    public function store()
    {
        var_dump('store');
    }

    public function update($request, $id)
    {
        var_dump('update');
    }

    public function destroy($id)
    {
        var_dump('destroy');
    }
}
