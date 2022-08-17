@extends('admin.master')
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{route('admin.category.index')}}">Category</a></li>
                <li class="breadcrumb-item active">Update Category</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="create_user card card-primary  card-outline">
                <div class="card-header">
                    <h3 >Update Category</h3>
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
                <form action="{{route('admin.category.update')}}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" value="{{$category->id}}" name="category_id">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input  name="name"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    value="{{$category->name}}">
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
