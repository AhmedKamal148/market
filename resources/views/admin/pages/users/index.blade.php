@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="users_table card card-danger card-outline ">
                <div  class="card-header d-flex justify-content-between align-items-center">
                    <h3> Users</h3>
                    <div class="search_block ml-auto">
                        <div class="card-tools">
                            <form action="{{route('admin.users.index')}}" method="get">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="search" placeholder="Search Users">
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
                        @foreach($users as $user)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card  card-outline card-danger bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    User Id {{$user->id}}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row ">
                                        <div class="col-8">
                                            <div class="user_info">
                                                <h2 class="lead text-capitalize"><b>{{$user->fullName}}</b></h2>
                                                <p class="text-muted text-sm"><b>Email: </b> {{$user->email}}</p>
                                            </div>
                                            <hr>
                                            <p class="text-muted text-sm"><b>Permissions: </b></p>
                                            <form>
                                        {{--  Will Show Here Permission Of User --}}
                                            </form>
                                        </div>
                                        <div class="col-4 text-center">
                                            <div class="user_image">
                                            <img src="{{asset($user->imageUrl)}}"
                                                 alt="user-avatar"
                                                 class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="user_controllers d-flex justify-content-around">
                                        @if(auth()->user()->hasPermission('update_users'))
                                        <a  href="{{route('admin.users.edit' , [$user->id])}}" class="btn btn-success">
                                            <span class="font-weight-bold mr-2">Edit</span>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @else
                                            <a  href="#" class="btn btn-success disabled">
                                                <span class="font-weight-bold mr-2">Edit</span>
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_users'))
                                            <form action="{{route('admin.users.delete')}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                                <button type="submit" class="btn btn-danger">
                                                  <span class="font-weight-bold mr-2">
                                                    Delete
                                                </span>
                                                    <i class="fas fa-minus-circle"></i>

                                                </button>
                                            </form>
                                        @else
                                            <button  class="btn btn-danger disabled">
                                                  <span class="font-weight-bold mr-2">
                                                    Delete
                                                </span>
                                                <i class="fas fa-minus-circle"></i>

                                            </button>
                                        @endif
                                            <a href="#" class="btn  btn-primary">
                                                <span class="font-weight-bold mr-2">View Profile</span>
                                                <i class="fas fa-user"></i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


                <div class="card-footer">
                    @if(auth()->user()->hasPermission('create_users'))
                    <a  class="btn btn-lg btn-outline-dark" href="{{route('admin.users.create')}}">Create User</a>
                    @else
                        <a  class="btn btn-lg btn-outline-dark disabled "  href="#" >Create User</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
