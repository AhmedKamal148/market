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
                        <div class="row d-flex ">
                            <div class="col-6 ">
                                <div class="select_group">
                                    <select name="category_id"
                                            class=" font-weight-bold custom-select form-control">
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

                            <div class="col-6">
                                <div class="input-group">
                                    <div class="form-outline">
                                        <input type="search" name="search" id="search" class="form-control"
                                               value="{{request()->search}}"/>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
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
                                                <th>
                                                    Action
                                                </th>

                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @if(count($products) > 0)

                                            @foreach($products as $product)
                                                <tr>
                                                    <td>{{$product->id}}</td>
                                                    <td class="text-nowrap">{{$product->name}}</td>
                                                    <td>{{$product->category->name}}</td>
                                                    <td>{{$product->purchase_price}}</td>
                                                    <td>{{$product->sale_price}}</td>
                                                    <td>{{$product->stock}}</td>
                                                    <td>{{$product->profit_percent}}</td>
                                                    <td>{{$product->description}}</td>
                                                    <td>
                                                        <img src="{{asset($product->imageUrl)}}" width="60px"
                                                             class="img-thumbnail"/>
                                                    </td>
                                                    {{-- Edit && Delete--}}
                                                    <td class="d-flex ">
                                                        <a class="btn btn-default mx-2"
                                                           href="{{route('admin.product.edit',$product)}}">
                                                            <i class="icon edit-icon fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{route('admin.product.destroy' , $product)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-default">
                                                                <i class="icon delete-icon fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10"> No Data Found</td>
                                            </tr>
                                        @endif

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
