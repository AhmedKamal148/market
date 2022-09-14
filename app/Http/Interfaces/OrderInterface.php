<?php

namespace App\Http\Interfaces;

interface OrderInterface
{
    public function index($request);

    public function products($order);

    public function destroy($order);
}
