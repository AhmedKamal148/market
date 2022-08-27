@extends('admin.master')
@section('header')
    <!--Row-->
    <div class="row mb-2">
        <!-- Breadcrumb -->
        <div class="offset-6 col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item active">Clients</li>
            </ol>
        </div>
        <!-- End Of Breadcrumb -->
    </div>
    <!-- End Of Row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="clients_table card card-danger card-outline ">
                {{-- Strat Card Header --}}
                <div class="card-header">
                    <form action="{{route('admin.client.index')}}" method="get">
                        <div class="row d-flex justify-content-end">
                            <div class="col-3">
                                <div class="search_group">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="Search Clients"
                                               value="{{request()->search}}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
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
                                    <h3 class="font-weight-bold text-capitalize"> clients
                                        <small class="font-weight-bold"> {{$clients->total()}}</small>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped font-weight-bold text-capitalize">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            @if(count($clients) >0)
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
                                        @foreach($clients as $client)
                                            <tr class="">
                                                <td>{{$client->id}}</td>
                                                <td>{{$client->name}}</td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @foreach($client->phone as $phone)
                                                            <li>
                                                                {{$phone}}
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </td>
                                                <td>{{$client->address}}</td>
                                                {{-- Edit && Delete--}}
                                                @if(count($clients) > 0)
                                                    <td class="text-success">
                                                        <a class="btn btn-lg btn-outline-success font-weight-bold"
                                                           href="{{route('admin.client.edit',[$client->id])}}">Edit</a>
                                                    </td>
                                                    <td class="text-danger">
                                                        <form action="{{route('admin.client.delete')}}"
                                                              method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" value="{{$client->id}}"
                                                                   name="client_id">
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
                                    {{$clients->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">

                    @if(auth()->user()->hasPermission('create_clients'))
                        <a
                                class="btn btn-lg btn-outline-dark font-weight-bold"
                                href="{{route('admin.client.create')}}">Create client</a>

                    @else
                        <a
                                class="btn btn-lg btn-outline-dark disabled font-weight-bold "
                                href="#">Create client</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection