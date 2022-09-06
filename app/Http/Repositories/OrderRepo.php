<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\OrderInterface;
use App\Http\Traits\orderAttachments;
use App\Models\Category;
use App\Models\Order;
use RealRashid\SweetAlert\Facades\Alert;

class OrderRepo implements OrderInterface
{
    use  orderAttachments;

    public function index($request)
    {
        if ($request->has('search')) {

            $orders = Order::whereHas('client', function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        $orders = Order::with('client')->paginate(5);

        return view('admin.pages.order.index', compact('orders'));
    }

    public function store($request, $client)
    {

        $this->attachOrder($request, $client);

        return redirect()->back();
    }

    public function create($client)
    {
        $categories = Category::with('product')->get();
        return view('admin.pages.order.create', compact('client', 'categories'));
    }

    public function products($order)
    {
        $products = $order->products;
        return view('admin.pages.order._products', compact('order', 'products'));

    }

    public function edit($client, $order)
    {
        $categories = Category::with('product')->get();
        return view('admin.pages.order.edit', compact('client', 'order', 'categories'));
    }

    public function destroy($order)
    {
        $this->deAttachOrder($order);
        Alert::error('Delete Successfully', "Delete Order Successfully!");
        return redirect(route('admin.order.index'));
    }

    public function update($request, $client, $order)
    {

        $this->deAttachOrder($order);
        $this->attachOrder($request, $client);
        Alert::success('Updated Successfully', "Update Order Successfully!");
        return redirect(route('admin.order.index'));
    }
}
