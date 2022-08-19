<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\ProductInterface;
use App\Http\Traits\ImagesTriat;
use App\Models\Category;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;


class ProductRepo implements ProductInterface
{
    use ImagesTriat;

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
            $this->UploadImage($image, $imageName, 'product');
        }
        $product = Product::create(
            [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'stock' => $request->stock,
                'image' => (isset($imageName)) ? $imageName : null,
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
        $product = Product::find($request->product_id);
        if ($request->has('image')) {
            $image = $request->image;
            $imageName = time() . '_product.' . $request->image->extension();
            $this->UploadImage($image, $imageName, 'product', $product->imageUrl);
        }
        $imageStore = $request->has('image') ? $request->imageUrl : $product->image;
        $request->merge(['image' => $imageStore]);


        $product = Product::update([$request->all()]);

        Alert::success("Update Product" , "Updated Successfully !");
        return redirect(route('admin.product.index'));

        /* $product->update(
             [
                 'name' => ($request->has('name')) ? $request->name : $product->name,
                 'description' => ($request->has('description')) ? $request->description : $product->description,
                 'image' => (isset($imageName)) ? $imageName : $product->imageUrl,
                 'purchase_price' => ($request->has('purchase_price')) ? $request->purchase_price : $product->purchase_price,
                 'sale_price' => ($request->has('sale_price')) ? $request->sale_price : $product->sale_price,
                 'stock' => ($request->has('stock')) ? $request->stock : $product->stock,
             ]);

         Alert::success("Update Product", "Updated Successfully !");
         return redirect(route('admin.product.index'));*/
    }


    /*    public function update($request,$product)
        {
            if($request->has('image'))
            {
                $image = $request->image;
                $imageName = time(). '_product' . $request->image->extension();
                $this->UploadImage($image,$imageName,'product' , $request->imageUrl);
            }
            dd($request)

            $imageStore = $request->has('image') ? $request->imageUrl : $product->image;
            $request->merge(['image' => $imageStore]);


            $product = Product::update([$request->all()]);

            Alert::success("Update Product" , "Updated Successfully !");
            return redirect(route('admin.product.index'));
        }*/

    public function delete($request)
    {
        $product = Product::find($request->product_id);

        $product->delete();
        Alert::error('Delete Product', 'Deleted Successfully!');
        return redirect()->route('admin.product.index');
    }


}
