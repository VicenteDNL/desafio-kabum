<?php

namespace App\Controllers;

use App\Models\Address;
use Bootstrap\Modules\Controller\Controller;
use Bootstrap\Modules\Response\Response;
use Throwable;

class AddressController extends Controller
{
    public function store($clientId)
    {
        try {
            $params = $this->request->getBodyParams([ 'street', 'number', 'complement', 'neighborhood', 'zip', 'state', 'city', 'country']);
            $address = new Address();
            $address->client_id = $clientId;
            $address->street = $params['street'];
            $address->number = $params['number'];
            $address->complement = $params['complement'];
            $address->neighborhood = $params['neighborhood'];
            $address->zip = $params['zip'];
            $address->state = $params['state'];
            $address->city = $params['city'];
            $address->country = $params['country'];
            $address->save();
            return Response::json(['status' => 'success', 'message' => 'Endereço salvo com sucesso', 'data' => $address->toArray() ]);

        } catch(Throwable $e) {
            return Response::json(['status' => 'error', 'message' => 'Ocorreu um problema ao salvar o endereço', 'data' => null ]);
        }

    }

    public function update($clientId, $id)
    {
        try {
            $address = Address::where('client_id', $clientId)
            ->where('id', $id)
            ->firstOrFail();
            $params = $this->request->getBodyParams([ 'street', 'number', 'complement', 'neighborhood', 'zip', 'state', 'city', 'country']);
            $address->street = $params['street'];
            $address->number = $params['number'];
            $address->complement = $params['complement'];
            $address->neighborhood = $params['neighborhood'];
            $address->zip = $params['zip'];
            $address->state = $params['state'];
            $address->city = $params['city'];
            $address->country = $params['country'];
            $address->save();
            return Response::json(['status' => 'success', 'message' => 'Endereço salvo com sucesso', 'data' => $address->toArray() ]);

        } catch(Throwable $e) {
            return Response::json(['status' => 'error', 'message' => 'Ocorreu um problema ao salvar o endereço', 'data' => null ]);
        }

    }

    public function destroy($clientId, $id)
    {
        try {
            $address = Address::where('client_id', $clientId)
            ->where('id', $id)
            ->firstOrFail();
            $address->delete();
            return Response::json(['status' => 'success', 'message' => 'Endereço DELETADO com sucesso', 'data' => null ]);
        } catch(Throwable $e) {
            return Response::json(['status' => 'error', 'message' => 'Endereço não encontrado', 'data' => null ]);
        }

    }
}
