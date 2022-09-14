<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderInterface;
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

    public function destroy(Order $order)
    {
        return $this->orderInterface->destroy($order);
    }

    public function products(Order $order)
    {
        return $this->orderInterface->products($order);
    }


}
