<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset("dashboard/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle
        elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Market</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset(auth()->user()->image_url)}}" class="img-circle elevation-2" alt="User Image">

            </div>
            <div class="info">
                <a href="#" class="d-block text-capitalize font-weight-bold">{{auth()->user()->full_name}}</a>
            </div>
        </div>


        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Home -->
                <li class="nav-item ">
                    <a href="{{route('admin.index')}}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <!-- Supervisors -->
                @if(auth()->user()->hasPermission('read_users'))
                    <li class="nav-item">
                        <a href="{{route('admin.users.index')}}" class="nav-link ">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Supervisors
                            </p>
                        </a>

                    </li>
                @endif
                <!-- Categories -->
                @if(auth()->user()->hasPermission('read_categories'))
                    <li class="nav-item">
                        <a href="{{route('admin.category.index')}}" class="nav-link ">
                            <i class=" nav-icon fas fa-dice-d6"></i>
                            <p>
                                Categories
                            </p>
                        </a>

                    </li>
                @endif
                <!-- Products -->
                @if(auth()->user()->hasPermission('read_products'))
                    <li class="nav-item">
                        <a href="{{route('admin.product.index')}}" class="nav-link ">
                            <i class=" nav-icon fas fa-dice-d6"></i>
                            <p>
                                Product
                            </p>
                        </a>

                    </li>
                @endif
                <!-- Clients -->
                @if(auth()->user()->hasPermission('read_clients'))
                    <li class="nav-item">
                        <a href="{{route('admin.client.index')}}" class="nav-link ">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Clients
                            </p>
                        </a>*
                    </li>
                @endif
                <!-- Clients -->
                @if(auth()->user()->hasPermission('read_orders'))
                    <li class="nav-item">
                        <a href="{{route('admin.order.index')}}" class="nav-link ">
                            <i class="nav-icon fab fa-shopify"></i>
                            <p>
                                Orders
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
