<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="bg-dark text-white" style="width: 250px; min-height: 100vh;">
            <div class="p-3">
                <div class="py-3">
                    <h2 class="h4 mb-0">Admin Panel</h2>
                </div>

                <nav class="mt-4">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                                <i class="bi bi-speedometer2 me-2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.books.index') }}" class="nav-link text-white">
                                <i class="bi bi-book me-2"></i>
                                <span>Manajemen Buku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link text-white">
                                <i class="bi bi-cart me-2"></i>
                                <span>Manajemen Pesanan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link text-white">
                                <i class="bi bi-people me-2"></i>
                                <span>Manajemen Pengguna</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="container-fluid">
                    <div class="d-flex justify-content-end align-items-center py-3">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                {{ Auth::guard('admin')->user()->name ?? Auth::user()->name }} <!-- Perbaikan di sini -->
                                <span class="badge bg-secondary ms-1">Admin</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="p-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>