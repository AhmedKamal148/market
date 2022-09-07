<?php

namespace App\Http\Interfaces;

interface UserInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($user, $request);
    public function destroy($user, $request);
}
