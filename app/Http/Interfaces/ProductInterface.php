<?php

namespace App\Http\Interfaces;

interface ProductInterface
{
    public function index($request);

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function delete($request);
}
