@extends('admin.master')
@section('header')
<div class="row mb-2">
    <div class="col-sm-6">

    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item active">categories</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="categories_table card card-danger card-outline ">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="search_block ml-auto">
                    <div class="card-tools">
                        <form action="{{route('admin.category.index')}}" method="get">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="search_category" placeholder="Search categories" value="{{request()->search}}">
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
                                <h3 class="font-weight-bold"> Categories <small class="font-weight-bold">{{$categories->total()}}</small></h3>

                            </div>
                            <div class="card-body">
                                <table class="table table-striped font-weight-bold text-capitalize">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Related Products</th>
                                            @if(count($categories) >0)
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
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td class="font-weight-bold text-capitalize">{{$category->name}}</td>
                                            <td class="font-weight-bold text-capitalize">
                                                <form action="{{route('admin.product.index')}}" method="get">
                                                    <input type="hidden" value="{{$category->id}}" name="category_id">
                                                    <button type="submit" class="btn btn-lg btn-outline-primary">
                                                        Products
                                                    </button>
                                                </form>

                                            </td>
                                            @if(count($categories) > 0)
                                            <td class="text-success">
                                                <a class="btn btn-lg btn-outline-success font-weight-bold" href="{{route('admin.category.edit', $category)
                                                           }}">Edit</a>
                                            </td>
                                            <td class="text-danger">
                                                <form action="{{route('admin.category.destroy' , $category)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    
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

                                {{$categories->appends(request()->query())->links()}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">

                @if(auth()->user()->hasPermission('create_categories'))
                <a class="btn btn-lg btn-outline-dark font-weight-bold" href="{{route('admin.category.create')}}">Create
                    Category</a>

                @else
                <a class="btn btn-lg btn-outline-dark disabled font-weight-bold " href="#">Create Category</a>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection