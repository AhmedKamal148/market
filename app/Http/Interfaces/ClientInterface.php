<?php

namespace App\Http\Interfaces;

interface ClientInterface
{
    public function index($request);

    public function create();

    public function store($request);

    public function edit($id);

    public function update($client, $request);

    public function destroy($client, $request);
}
