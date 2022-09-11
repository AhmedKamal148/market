<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\OrderClientInterface;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderClientRepo implements OrderClientInterface
{

    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }

    public function create(Client $client)
    {
        $categories = Category::with('product')->get();
        return view('admin.pages.order.create', compact('client', 'categories'));
    }

    public function store(Request $request, Client $client)
    {
        // TODO: Implement store() method.
    }

    public function edit(Client $client, Order $order)
    {
        // TODO: Implement edit() method.
    }

    public function update(Request $request, Client $client, Order $order)
    {
        // TODO: Implement update() method.
    }

    public function destroy(Client $client, Order $order)
    {
        // TODO: Implement destroy() method.
    }
}
