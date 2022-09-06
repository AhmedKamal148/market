<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ProductInterface;
use App\Http\Requests\product\CreateProductRequest;
use App\Http\Requests\product\DeleteProductRequest;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        return $this->productInterface = $productInterface;
    }

    public function index(Request $request)
    {
        return $this->productInterface->index($request);
    }


    public function create()
    {
        return $this->productInterface->create();
    }


    public function store(CreateProductRequest $request)
    {
        return $this->productInterface->store($request);
    }


    public function show(product $product)
    {
        return $this->productInterface->show($product);

    }


    public function edit($id)
    {
        return $this->productInterface->edit($id);

    }


    public function update(Request $request)
    {
        return $this->productInterface->update($request);

    }


    public function destroy(DeleteProductRequest $request)
    {
        return $this->productInterface->delete($request);
    }
}
