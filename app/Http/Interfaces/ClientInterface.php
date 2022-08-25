<?php

namespace App\Http\Interfaces;

interface ClientInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($client);

    public function update($request, $client);

    public function destroy($client);

    public function show($client);
}
