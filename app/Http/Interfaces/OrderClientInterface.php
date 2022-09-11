<?php

namespace App\Http\Interfaces;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

interface OrderClientInterface
{
    public function index(Request $request);

    public function create(Client $client);

    public function store(Request $request, Client $client);

    public function edit(Client $client, Order $order);

    public function update(Request $request, Client $client, Order $order);

    public function destroy(Client $client, Order $order);

}
