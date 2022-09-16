<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\OrderClientInterface;
use App\Http\Traits\attachmentOrder;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;


class OrderClientRepo implements OrderClientInterface
{
    use  attachmentOrder;

    public function store($request, $client)
    {

        $request->validate([
            'products' => 'required|array',
        ]);

        $this->attachOrder($request, $client);

        Alert::success('Created Order ', 'Create Order Successfully !');
        return redirect()->back();
    }

    public function create($client)
    {
        $categories = Category::with('product')->get();
        return view('admin.pages.order.create', compact('client', 'categories'));
    }


    public function edit($client, $order)
    {
        $categories = Category::with('product')->get();

        return view('admin.pages.order.edit', compact('client', 'order', 'categories'));
    }

    public function update($request, $client, $order)
    {
        $this->detachOrder($order);
        $this->attachOrder($request, $client);
        Alert::success('Order Updated', 'Order Updated Successfully!');
        return redirect(route('admin.order.index'));
    }

    public function destroy($client, $order)
    {
        // TODO: Implement destroy() method.
    }
}
