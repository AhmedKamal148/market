<?php

namespace App\Http\Interfaces;

interface OrderClientInterface
{
    public function index();

    public function create($client);

    public function store($request, $client);

    public function edit($order);

    public function show($order);

    public function update($request, $order);

    public function destroy($order);
}
