<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\ProductInterface;
use App\Models\Category;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;


class ProductRepo implements ProductInterface
{

    public function index($request)
    {
        $products = Product::with('category')->get();
        $products = Product::when($request->category_id, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        })->paginate(4);


        $categories = Category::get();
        return view('admin.pages.product.index', compact('products', 'categories'));

    }

    public function store($request)
    {

        if ($request->has('image')) {
            $image = $request->image;
            $imageName = time() . '_product' . $request->image->extension();
        }
        $product = Product::create(
            [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'stock' => $request->stock,
//                'image' => (isset($imageName)) ? $imageName : null,
                'description' => $request->description,
            ]
        );
        Alert::success('Create Product', "Create {{$product->name}} Successfully!");
        return redirect()->back();
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.product.create', compact('categories'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.pages.product.edit', compact('product'));
    }

    public function update($request)
    {
        /*        $product = Product::find($request->product_id);
                if ($request->has('image')) {
                    $image = $request->image;
                    $imageName = time() . '_product.' . $request->image->extension();
                    if ($image->getClientOriginalName() == 'default.jpg') {

                    } else {

                    }
                }
                $imageStore = (isset($imageName)) ? $imageName : $product->image;
                $request->merge(['imageUrl' => $imageStore]);
                $product->update([$request]);
                Alert::success("Update Product", "Updated Successfully !");
                return redirect(route('admin.product.index'));*/

    }

    public function delete($request)
    {
        $product = Product::find($request->product_id);
        $product->delete();
        Alert::error('Delete Product', 'Deleted Successfully!');
        return redirect()->route('admin.product.index');
    }


}
