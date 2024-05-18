<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Project</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Admin</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('organizations.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Organizations</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order-details.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Order Details</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order-files.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Order files</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order-tasks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Order tasks</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-labels.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Product Label</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-storages.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Product Storage</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('return-orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Return Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Role</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stock-entries.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Stock Entry</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('storage-blocks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Storage Block</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('warehouses.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>Warehouse</p>
                        </a>
                    </li>
                    <!-- Add other sidebar items here -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024</strong>
    </footer>
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
