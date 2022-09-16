<?php

namespace App\Http\Traits;

use App\Models\Product;

trait attachmentOrder
{
    private function attachOrder($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::find($id);

            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update(['stock' => $product->stock - $quantity['quantity']]);

        }
        $order->update(['total_price' => $total_price]);
    }

    private function detachOrder($order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }
}
