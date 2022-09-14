<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\OrderClientInterface;
use App\Models\Category;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class OrderClientRepo implements OrderClientInterface
{

    public function index($request)
    {
        // TODO: Implement index() method.
    }

    public function store($request, $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);


        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price = 0;


        foreach ($request->products as $id => $quantity) {

            $product = Product::find($id);

            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update(['stock' => $product->stock - $quantity['quantity']]);

        }
        $order->update(['total_price' => $total_price]);

        Alert::success('Created Order ', 'Create Order Successfully !');
//        return redirect(route('admin.order.index'));
        return redirect()->back();
    }

    public function create($client)
    {
        $categories = Category::with('product')->get();
        return view('admin.pages.order.create', compact('client', 'categories'));
    }

    public function update($request, $client, $order)
    {
        // TODO: Implement update() method.
    }

    public function edit($client, $order)
    {
        // TODO: Implement edit() method.
    }

    public function destroy($client, $order)
    {
        // TODO: Implement destroy() method.
    }
}
