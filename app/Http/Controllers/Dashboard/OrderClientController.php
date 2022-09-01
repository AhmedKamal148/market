<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderClientInterface;
use App\Http\Requests\order\CreateOrderRequest;
use App\Http\Requests\order\UpdateOrderRequest;
use App\Models\Client;
use App\Models\Order;

class OrderClientController extends Controller
{
    protected $orderInterface;

    public function __construct(OrderClientInterface $orderInterface)
    {
        return $this->orderInterface = $orderInterface;
    }

    public function index()
    {
        return $this->orderInterface->index();
    }

    public function create(Client $client)
    {
        return $this->orderInterface->create($client);
    }

    public function store(CreateOrderRequest $request, Client $client)
    {
        return $this->orderInterface->store($request, $client);
    }

    public function show(Order $order)
    {
        return $this->orderInterface->show($order);
    }


    public function edit(Order $order)
    {
        return $this->orderInterface->edit($order);

    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        return $this->orderInterface->update($request, $order);

    }

    public function destroy(Order $order)
    {
        return $this->orderInterface->destroy($order);

    }
}
