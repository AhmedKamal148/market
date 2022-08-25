<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ClientInterface;
use App\Models\client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    protected $clientInterface;

    public function __construct(ClientInterface $clientInterface)
    {
        return $this->clientInterface = $clientInterface;
    }

    public function index()
    {
        return $this->clientInterface->index();
    }

    public function store(Request $request)
    {
        return $this->clientInterface->create();

    }

    public function create()
    {
        return $this->clientInterface->create();

    }

    public function show(client $client)
    {
        return $this->clientInterface->show($client);

    }


    public function edit(client $client)
    {
        return $this->clientInterface->edit($client);

    }


    public function update(Request $request, client $client)
    {
        return $this->clientInterface->update($request, $client);

    }


    public function destroy(client $client)
    {
        return $this->clientInterface->destroy($client);

    }
}
