<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\OrderInterface;
use App\Http\Traits\attachmentOrder;
use App\Models\Order;
use RealRashid\SweetAlert\Facades\Alert;

class OrderRepo implements OrderInterface
{
    use attachmentOrder;

    public function index($request)
    {
        if ($request->has('search')) {
            $orders = Order::whereHas('client', function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%');
            })->paginate(5);
        } else {
            $orders = Order::with('products')->paginate(5);

        }

        return view('admin.pages.order.index', compact('orders'));
    }

    public function products($order)
    {
        $products = $order->products;
        return view('admin.pages.order._products', compact('products'));

    }

    public function destroy($order)
    {
        $this->detachOrder($order);
        Alert::warning('Order Delete', 'Order Deleted Successfully!');
        return redirect(route('admin.order.index'));

    }
}
