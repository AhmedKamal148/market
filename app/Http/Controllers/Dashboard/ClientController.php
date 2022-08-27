<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ClientInterface;
use App\Http\Requests\client\CreateClientRequest;
use App\Http\Requests\client\DeleteClientRequest;
use App\Http\Requests\client\UpdateClientRequest;
use App\Models\client;
use Illuminate\Http\Request;


class ClientController extends Controller
{

    protected $clientInterface;

    public function __construct(ClientInterface $clientInterface)
    {
        return $this->clientInterface = $clientInterface;
    }

    public function index(Request $request)
    {
        return $this->clientInterface->index($request);
    }

    public function store(CreateClientRequest $request)
    {
        return $this->clientInterface->store($request);

    }

    public function create()
    {
        return $this->clientInterface->create();

    }

    public function show(Client $client)
    {
        return $this->clientInterface->show($client);

    }


    public function edit($id)
    {
        return $this->clientInterface->edit($id);

    }


    public function update(UpdateClientRequest $request)
    {
        return $this->clientInterface->update($request);

    }


    public function delete(DeleteClientRequest $request)
    {

        return $this->clientInterface->delete($request);

    }
}
