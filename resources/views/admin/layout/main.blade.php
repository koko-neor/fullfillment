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
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.home') }}" class="brand-link">
            <span class="brand-text font-weight-light">Проект</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Админ</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('organizations.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Организации</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Заявки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order-details.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Детали заявки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order-files.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Файлы заявки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order-tasks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Задачи по заявке</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Продукты</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-labels.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Этикетки продукта</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-storages.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Хранение продуктов</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('return-orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Возврат заявки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Роль</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stock-entries.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Поступления на склад</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('storage-blocks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-product-hunt"></i>
                            <p>Складские блоки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Пользователь</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('warehouses.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>Склад</p>
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
