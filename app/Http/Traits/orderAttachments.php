<?php

namespace App\Http\Traits;


use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

trait orderAttachments
{

    private function attachOrder($request, $client)
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
    }


    private function deAttachOrder($order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }
}
