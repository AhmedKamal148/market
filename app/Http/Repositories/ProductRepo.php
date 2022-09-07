<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
            $image = Image::make($request->image);
            $imageName = $request->image->hashName();
            $image->save(public_path('images/product/') . $imageName, 100, $request->image->extension());
        }
        $product = Product::create(
            [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'stock' => $request->stock,
                'image' => (isset($imageName)) ? $imageName : 'default.jpg',
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
        $product = Product::with('category')->find($id);
        $categories = Category::all();

        return view('admin.pages.product.edit', compact('product', 'categories'));
    }

    public function update($product, $request)
    {
        // Check If Request Has Image && Image Not Equal Default Image ;
        if ($request->has('image')) {
            if ($product->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/product/' . $product->image);
            }
            $img = Image::make($request->image);
            $imageName = $request->image->hashName();
            $img->save(public_path('images/product/') . $imageName, 100, $request->image->extension());
        }
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'image' => (isset($imageName)) ? $imageName : $product->image,
            'description' => $request->description,

        ]);

        Alert::success("Update Product", "Updated Successfully !");
        return redirect(route('admin.product.index'));
    }

    public function destroy($product, $request)
    {
        if ($product->image != 'default.jpg') {
            Storage::disk('public_uploads')->delete('/product/' . $product->image);
        }
        $product->delete();
        Alert::error('Delete Product', 'Deleted Successfully!');
        return redirect()->route('admin.product.index');
    }
}
