@extends('admin.master')
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{route('admin.users.index')}}">Users</a></li>
                <li class="breadcrumb-item active">Create User</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="create_user card card-primary  card-outline">
                <div class="card-header">
                    <h3>Create User</h3>
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
                <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input name="first_name"
                                   required
                                   type="text"
                                   class="form-control"
                                   id="firstName"
                                   placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input name="last_name"
                                   required
                                   type="text"
                                   class="form-control"
                                   id="lastName"
                                   placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input name="email"
                                   required
                                   type="email"
                                   class="form-control"
                                   id="email"
                                   placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password"
                                   required
                                   type="password"
                                   class="form-control"
                                   id="password"
                                   placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmation">Confirm Password</label>
                            <input name="password_confirmation"
                                   required
                                   type="password"
                                   class="form-control"
                                   id="passwordConfirmation"
                                   placeholder="Re-Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="image">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        {{--Preview Image--}}
                        <div class="form-group">
                            <img src="{{asset('images/user/default.jpg')}}"
                                 id="image_preview"
                                 class="img-thumbnail"
                                 width="100px"/>
                        </div>

                        <hr>
                        {{--*********************** permissions *********************--}}
                        <div class="permissions">
                            <h4 class=" "><b>Permissions: </b></h4>
                            <div class="permissions_content d-flex justify-content-between  flex-column">
                                @foreach($models as $model)
                                    <ul class="list-unstyled">
                                        <li>
                                            <h4 class="text-capitalize font-weight-bold ">{{$model}}</h4>
                                            <ul class="list-unstyled ml-1">
                                                <li>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="create_{{$model}}"
                                                                   class="custom-control-input
                                                                custom-control-input-primary"
                                                                   id="createSwitch1{{$model}}">
                                                            <label class="custom-control-label text-muted"
                                                                   for="createSwitch1{{$model}}">Create</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="read_{{$model}}"
                                                                   class="custom-control-input
                                                                custom-control-input-fuchsia"
                                                                   id="readSwitch2{{$model}}">
                                                            <label class="custom-control-label text-muted"
                                                                   for="readSwitch2{{$model}}">Read</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="update_{{$model}}"
                                                                   class="custom-control-input
                                                                custom-control-input-success"
                                                                   id="updateSwitch3{{$model}}">
                                                            <label class="custom-control-label text-muted"
                                                                   for="updateSwitch3{{$model}}">Update</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="delete_{{$model}}"
                                                                   class="custom-control-input
                                                                custom-control-input-danger"
                                                                   id="deleteSwitch4{{$model}}">
                                                            <label class="custom-control-label text-muted"
                                                                   for="deleteSwitch4{{$model}}">Delete</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <hr>
                                        </li>

                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-lg btn-outline-primary">
                            <span class="mr-2">Create </span>
                            <i class="nav-icon fas fa-user-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
