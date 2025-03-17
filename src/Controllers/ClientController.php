<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\Client;
use Bootstrap\Modules\Controller\Controller;

/**
 * TODO: verifica para que a chamada nao seja feito direto de uma classe do modulo (remover aclopamento)
 */
use Bootstrap\Modules\Response\Response;
use Throwable;

class ClientController extends Controller
{
    public function index()
    {

        return Response::json(['status' => 'success', 'data' => Client::with('addresses')->get()]);
    }

    public function show($id)
    {
        return Response::json(['status' => 'success', 'data' => Client::with('addresses')->find($id)]);
    }

    public function store()
    {
        $params = $this->request->getBodyParams();

        $client = new Client();
        $client->name = $params['name'];
        $client->date_of_birth = $params['date_of_birth'];
        $client->document = $params['document'];
        $client->general_registration = $params['general_registration'];
        $client->phone_number = $params['phone_number'];
        $client->save();
        $client->addresses = Address::where('client_id', $client->id)->get();
        return Response::json(['status' => 'success', 'message' => 'Cliente cadastrado com sucesso', 'data' => $client->toArray()]);
    }

    public function update($id)
    {

        $params = $this->request->getBodyParams();
        $client = Client::find($id);
        $client->name = $params['name'];
        $client->date_of_birth = $params['date_of_birth'];
        $client->document = $params['document'];
        $client->general_registration = $params['general_registration'];
        $client->phone_number = $params['phone_number'];
        $client->save();
        return Response::json(['status' => 'success', 'data' => $client->toArray()]);

    }

    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            return Response::json(['status' => 'success', 'message' => 'Cliente DELETADO com sucesso', 'data' => null ]);
        } catch(Throwable $e) {
            return Response::json(['status' => 'error', 'message' => 'Cliente não encontrado', 'data' => null ]);
        }

    }
}
