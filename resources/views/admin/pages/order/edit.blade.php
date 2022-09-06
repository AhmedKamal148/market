@extends('admin.master')
@section('header')
    <!--Row-->
    <div class="row mb-2">
        <!-- Breadcrumb -->
        <div class="offset-6 col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.order.index')}}">Orders</a></li>
                <li class="breadcrumb-item active">Update Order</li>
            </ol>
        </div>
        <!-- End Of Breadcrumb -->
    </div>
    <!-- End Of Row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="‘update_user card card-primary  card-outline p-2">
                <div class="card-header">
                    <h3>Update Order</h3>
                </div>
                {{--Check Errors--}}
                @if($errors->any())
                    <div class="card card-body ">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="callout callout-danger font-weight-bold text-danger text-capitalize">
                                    {{ $error}}
                                </li>
                            @endforeach
                        </ul>
                        @endif

                        {{--Update Ordere--}}
                        <div class="row my-3">
                            {{--Categories With Orders Data --}}
                            <div class="col-md-6">
                                <div class="card card-dark card-outline categories_content">
                                    <div class="card-header">
                                        <h3 class="">Categories</h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach($categories as $category)
                                            <div class="card card-dark card-outline ">
                                                <a class="d-block w-100 collapsed" data-toggle="collapse"
                                                   href="#{{$category->name}}">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            {{$category->name}}
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="{{$category->name}}" class="collapse">
                                                    <div class="card-body">
                                                        <table
                                                            class="table table-striped font-weight-bold text-capitalize ">
                                                            @if($category->product->count() > 0)
                                                                <thead class="thead-dark">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Name</th>
                                                                    <th>Price</th>
                                                                    <th>Stock</th>
                                                                    <th>Image</th>
                                                                    <th>Add Product</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($category->product as $product)
                                                                    <tr class="align-items-center">
                                                                        <td>{{$product->id}}</td>
                                                                        <td class="text-wrap">{{$product->name}}</td>
                                                                        <td>{{$product->sale_price}}</td>
                                                                        <td>{{$product->stock}}</td>
                                                                        <td>
                                                                            <img src="{{asset($product->imageUrl)}}"
                                                                                 width="60px"
                                                                                 class="img-thumbnail img-fluid">
                                                                        </td>
                                                                        <td>
                                                                            <a href="#"
                                                                               id="product-{{$product->id}}"
                                                                               data-name="{{$product->name}}"
                                                                               data-id="{{$product->id}}"
                                                                               data-price="{{$product->sale_price}}"
                                                                               class="btn {{in_array($product->id, $order->products->pluck('id')->toArray()) ? "btn-default disabled" : "btn-success"}} btn-sm add-product-btn">
                                                                                <i class=" nav-icon fas fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <p>No Data Found</p>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                        </table>


                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            {{--Orders--}}
                            <div class="col-md-6">
                                <div class="card card-danger card-outline">
                                    <div class="card-header">
                                        <h3> The Orders</h3>
                                    </div>

                                    <form
                                        action="{{route('admin.order.update',[$client,$order])}}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <div class="card-body">
                                            <table class="table table-striped font-weight-bold text-capitalize ">
                                                <thead class="thead-dark border border-bottom">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tBody">
                                                @foreach($order->products as $product)
                                                    <tr id="orderRow">
                                                        <td>{{$product->name}}</td>
                                                        <td>
                                                            <input type="number"
                                                                   name="products[{{$product->id}}][quantity]"
                                                                   class="form-control input-sm product-quantity"
                                                                   min="1"
                                                                   value="{{$product->pivot->quantity}}"/>
                                                        </td>
                                                        <td id="price"
                                                            data-price="{{$product->sale_price}}">{{$product->sale_price * $product->pivot->quantity}}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-danger" id="deleteOrder"
                                                               data-id="{{$product->id}}">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer text-center">
                                            <h4 class="font-weight-bold mb-2">Total Cost =
                                                <span id="totalCost">{{$order->total_price}}</span>
                                            </h4>
                                            <button type="submit"
                                                    class="btn btn-primary d-block font-weight-bold disabled"
                                                    id="add-order-btn">Update
                                                Order
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
