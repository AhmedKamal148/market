@extends('admin.master')
@section('header')
    <!--Row-->
    <div class="row mb-2">
        <!-- Breadcrumb -->
        <div class="offset-6 col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </div>
        <!-- End Of Breadcrumb -->
    </div>
    <!-- End Of Row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="products_table card card-danger card-outline ">
                {{-- Strat Card Header --}}
                <div class="card-header">
                    <form action="{{route('admin.product.index')}}" method="get">
                        <div class="row d-flex justify-content-end">
                            <div class="col-3  ">
                                <div class="search_group">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="Search Products"
                                               value="{{request()->search}}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3  ">
                                <div class="select_group">
                                    <select name="category_id"
                                            class=" font-weight-bold custom-select form-control-border b-3 border-primary">
                                        <option value="" class="font-weight-bold">Select ALL</option>
                                        @foreach($categories as  $category)
                                            <option {{ request()->category_id == $category->id ? 'selected' : '' }}
                                                    class="font-weight-bold"
                                                    value="{{$category->id}}">
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </form>

                </div>
                {{-- Strat Card Body --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="font-weight-bold text-capitalize"> products
                                        <small class="font-weight-bold"> {{$products->total()}}</small></h3>

                                </div>
                                <div class="card-body">
                                    <table class="table table-striped font-weight-bold text-capitalize ">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th class="text-nowrap">Purchase Price</th>
                                            <th class="text-nowrap">Sale Price</th>
                                            <th>Stock</th>
                                            <th>Profit</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            @if(count($products) >0)
                                                <th class="text-success">
                                                    Edit
                                                </th>
                                                <th class="text-danger">
                                                    Delete
                                                </th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr class="">
                                                <td>{{$product->id}}</td>
                                                <td class="text-nowrap">{{$product->name}}</td>
                                                <td>{{$product->category->name}}</td>
                                                <th>{{$product->purchase_price}}</th>
                                                <th>{{$product->sale_price}}</th>
                                                <th>{{$product->stock}}</th>
                                                <th>{{$product->profit_percent}}</th>
                                                <th>{{$product->description}}</th>
                                                <th>
                                                    <img src="{{asset($product->imageUrl)}}"
                                                         width="60px"
                                                         class="img-thumbnail"/>
                                                </th>
                                                {{-- Edit && Delete--}}
                                                @if(count($products) > 0)
                                                    <td class="text-success">
                                                        <a class="btn btn-lg btn-outline-success font-weight-bold"
                                                           href="{{route('admin.product.edit',[$product->id])}}">Edit</a>
                                                    </td>
                                                    <td class="text-danger">
                                                        <form action="{{route('admin.product.delete')}}"
                                                              method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" value="{{$product->id}}"
                                                                   name="product_id">
                                                            <button class="btn btn-lg
                                                            btn-outline-danger font-weight-bold">Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer clearfix">

                                    {{$products->links()}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">

                    @if(auth()->user()->hasPermission('create_products'))
                        <a
                                class="btn btn-lg btn-outline-dark font-weight-bold"
                                href="{{route('admin.product.create')}}">Create product</a>

                    @else
                        <a
                                class="btn btn-lg btn-outline-dark disabled font-weight-bold "
                                href="#">Create product</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
