@extends('admin.master')
@section('header')
    <!--Row-->
    <div class="row mb-2">
        <!-- Breadcrumb -->
        <div class="offset-6 col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.client.index')}}">Client</a></li>
                <li class="breadcrumb-item active">Create Client</li>
            </ol>
        </div>
        <!-- End Of Breadcrumb -->
    </div>
    <!-- End Of Row -->
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="create_user card card-primary  card-outline">
                <div class="card-header">
                    <h3>Create Client</h3>
                </div>
                @if($errors->any())
                    <div class="card card-body ">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="callout callout-danger font-weight-bold text-danger text-capitalize">
                                    {{ $error}}
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <form action="{{route('admin.client.store')}}" method="post">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name"
                                   required
                                   type="text"
                                   class="form-control"
                                   id="name"
                                   placeholder="Client Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input name="phone[]"
                                   required
                                   type="text"
                                   class="form-control"
                                   id="phone"
                                   placeholder="Client Phone">
                        </div>
                        <div class="form-group">
                            <label for="phone">Extra Phone</label>
                            <input name="phone[]"
                                   type="text"
                                   class="form-control"
                                   id="phone"
                                   placeholder="Add Another Phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>

                            <textarea
                                    class="form-control"
                                    name="address"
                                    id="address"
                                    required
                                    placeholder="Client Address"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-lg btn-outline-primary">
                            <span class="mr-2">Create Client</span>
                            <i class="nav-icon fas fa-user-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
