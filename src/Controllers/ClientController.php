<?php

namespace App\Controllers;

use Bootstrap\Modules\Controller\Controller;

class ClientController extends Controller
{
    public function index()
    {
        var_dump('index');
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
