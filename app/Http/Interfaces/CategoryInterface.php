<?php

namespace App\Http\Interfaces;

interface CategoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($category, $request);
    public function destroy($category, $request);
}
