<?php

namespace App\Http\Controllers\Dashboard\client;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderClientInterface;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderClientController extends Controller
{

    protected $orderClientInterface;

    public function __construct(OrderClientInterface $orderClientInterface)
    {
        return $this->orderClientInterface = $orderClientInterface;
    }

    public function index(Request $request)
    {
        return $this->orderClientInterface->index($request);
    }


    public function create(Client $client)
    {
        return $this->orderClientInterface->create($client);
    }


    public function store(Request $request, Client $client)
    {
        return $this->orderClientInterface->store($request, $client);
    }


    public function edit(Client $client, Order $order)
    {
        return $this->orderClientInterface->edit($client, $order);

    }

    public function update(Request $request, Client $client, Order $order)
    {
        return $this->orderClientInterface->update($request, $client, $order);

    }

    public function destroy(Client $client, Order $order)
    {
        return $this->orderClientInterface->destroy($client, $order);

    }
}
