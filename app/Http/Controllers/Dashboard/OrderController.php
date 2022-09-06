<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderInterface;
use App\Http\Requests\order\CreateOrderRequest;
use App\Http\Requests\order\UpdateOrderRequest;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        return $this->orderInterface = $orderInterface;
    }

    public function index(Request $request)
    {
        return $this->orderInterface->index($request);
    }

    public function create(Client $client)
    {
        return $this->orderInterface->create($client);
    }

    public function store(CreateOrderRequest $request, Client $client)
    {
        return $this->orderInterface->store($request, $client);
    }

    public function edit(Client $client, Order $order)
    {
        return $this->orderInterface->edit($client, $order);

    }


    public function update(UpdateOrderRequest $request, Client $client, Order $order)
    {
        return $this->orderInterface->update($request, $client, $order);

    }

    public function destroy(Order $order)
    {

        return $this->orderInterface->destroy($order);

    }

    public function products(Order $order)
    {
        return $this->orderInterface->products($order);
    }


}
