@extends('admin.master')
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{route('admin.product.index')}}">Product</a></li>
                <li class="breadcrumb-item active">Update Product</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="create_user card card-primary  card-outline">
                <div class="card-header">
                    <h3>Update Product</h3>
                </div>
                @if($errors->any())
                    <div class="card card-body ">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="callout callout-danger font-weight-bold text-danger text-capitalize">{{ $error
                                }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <form action="{{route('admin.product.update' , $product)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" value="{{$product->id}}" name="product_id">
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name"
                                   type="text"
                                   class="form-control"
                                   id="name"
                                   value="{{$product->name}}"
                            >

                        </div>

                        <div class="form-group">
                            <label>Categories</label>
                            <select class="form-control" name="category_id">
                                <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="purchase_price">Purchase Price</label>
                            <input name="purchase_price"
                                   type="number"
                                   class="form-control"
                                   id="purchase_price"
                                   placeholder="Purchase Price"
                                   value="{{$product->purchase_price}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="sale_price">Sale Price</label>
                            <input name="sale_price"
                                   type="number"
                                   class="form-control"
                                   id="sale_price"
                                   placeholder="Sale Price"
                                   value="{{$product->sale_price}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input name="stock"
                                   type="number"
                                   class="form-control"
                                   id="stock"
                                   placeholder="Stock"
                                   value="{{$product->stock}}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image"
                                           type="file"
                                           class="custom-file-input"
                                           id="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        {{--Preview Image--}}
                        <div class="form-group">
                            <img src="{{asset($product->imageUrl)}}"
                                 id="image_preview"
                                 class="img-thumbnail"
                                 width="100px"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Enter Description"
                            >{{$product->description}} </textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-lg btn-outline-primary">
                            <span class="mr-2">Update </span>
                            <i class="nav-icon fas fa-edit"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
