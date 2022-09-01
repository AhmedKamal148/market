<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\OrderClientInterface;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class OrderClientClientRepo implements OrderClientInterface
{

    public function index()
    {
        $orders = Order::with('client')->paginate(5);

        return view('admin.pages.order.index', compact('orders'));
    }

    public function store($request, $client)
    {

        $order = $client->orders()->create([]); // To Get ID From Order [ Can't Create Order Without Client ]

        $order->Products()->attach($request->products);// Insert Into Product_order Table

        $totalPrice = 0;  // To Calculate  Total_Price Of Order


        foreach ($request->products as $id => $quantity) {

            $product = Product::find($id);

            $totalPrice += $product->sale_price * $quantity['quantity'];

            $product->update(['stock' => $product->stock - $quantity['quantity']]); // Update Stock On Product Table [$quantity is An Array]
        }

        $order->update(['total_price' => $totalPrice]); // Update Order Total Price Depend On Cost Of Products

        Alert::success('Create Order', 'Created Successfully');

        return redirect()->back();
    }

    public function create($client)
    {
        $categories = Category::with('product')->get();
        return view('admin.pages.order.create', compact('client', 'categories'));
    }

    public function update($request, $order)
    {

    }

    public function edit($order)
    {

    }

    public function show($order)
    {

    }

    public function destroy($order)
    {

    }
}
