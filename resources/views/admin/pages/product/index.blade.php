@extends('admin.master')
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">

        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item active">products</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="products_table card card-danger card-outline ">
                <div  class="card-header d-flex justify-content-between align-items-center">
                    <div class="search_block ml-auto">
                        <div class="card-tools">
                            <form action="{{route('admin.product.index')}}" method="get">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="search_product"
                                       placeholder="Search products"
                                       value="{{request()->search}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="font-weight-bold"> products <small
                                                class="font-weight-bold">{{$products->total()
                                    }}</small></h3>

                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
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
                                            <tr>
                                                <td >{{$product->id}}</td>
                                                <td class="font-weight-bold text-capitalize">{{$product->name}}</td>
                                                @if(count($products) > 0)
                                                    <td class="text-success">
                                                        <a class="btn btn-lg btn-outline-success font-weight-bold"
                                                           href="{{route('admin.product.edit',[$product->id])
                                                           }}">Edit</a>
                                                    </td>
                                                    <td class="text-danger">
                                                        <form action="{{route('admin.product.delete')}}"
                                                              method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" value="{{$product->id}}"
                                                                   name="product_id">
                                                            <button class="btn btn-lg
                                                            btn-outline-danger font-weight-bold">Delete</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer clearfix">

                                    {{$products->appends(request()->query())->links()}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">

                    @if(auth()->user()->hasPermission('create_products'))
                    <a  class="btn btn-lg btn-outline-dark font-weight-bold" href="{{route('admin.product.create')
                    }}">Create
                        product</a>

                    @else
                        <a  class="btn btn-lg btn-outline-dark disabled font-weight-bold "  href="#" >Create product</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
