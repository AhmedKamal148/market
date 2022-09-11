@extends('admin.master')
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">

        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="orders_table card card-danger card-outline ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{--Search --}}
                    <div class="search_block ml-auto">
                        <div class="card-tools">
                            <form action="{{route('admin.order.index')}}" method="get">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="search"
                                           placeholder="Search orders"
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
                    <div class="row" id="products_order_row">
                        <div class="col-md-8">
                            <div class="card orders_table">
                                {{--Header Of Table--}}
                                <div class="card-header">
                                    <h3 class="font-weight-bold"> Orders
                                        <small class="font-weight-bold">{{$orders->total()}}</small>
                                    </h3>

                                </div>
                                <div class="card-body">
                                    <table class="table table-striped font-weight-bold text-capitalize">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Client Name</th>
                                            <th>Total Price</th>
                                            <th>Created At</th>
                                            @if(count($orders) >0)
                                                <th class="text-info">
                                                    Actions
                                                </th>

                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>

                                                <td>{{$order->id}}</td>
                                                <td class="font-weight-bold text-capitalize">{{$order->Client->name}}</td>
                                                <td>{{$order->total_price}}</td>
                                                <td>{{$order->created_at->toFormattedDateString()}}</td>
                                                @if(count($orders) > 0 && auth()->user()->hasPermission('update_orders'))

                                                    <td class="text-success">
                                                        <a class="btn btn-outline-info font-weight-bold showProducts"
                                                           data-url="{{route('admin.order.products',[$order])}}"
                                                           data-method="get">
                                                            Show
                                                        </a>
                                                        <a class="btn btn-outline-success font-weight-bold"
                                                           href="{{route('admin.order.edit',[$order->client,$order])}}">
                                                            Edit
                                                        </a>

                                                        <form action="{{route('admin.order.destroy',$order)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <button class="btn
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

                                    {{$orders->appends(request()->query())->links()}}

                                </div>
                            </div>
                        </div>
                        {{--product_order_Invoice--}}
                        <div class="col-md-4 product_order_Invoice">

                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">

                    @if(auth()->user()->hasPermission('create_orders'))
                        <a class="btn btn-lg btn-outline-dark font-weight-bold"
                           href="{{route('admin.order.create',[$order->client])}}">
                            <span> Create order</span>
                            <i class="fas fa-plus"></i>
                        </a>

                    @else
                        <a class="btn btn-lg btn-outline-dark disabled font-weight-bold " href="#">Create order</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
