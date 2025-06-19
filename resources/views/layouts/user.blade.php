<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jejak Literasi')</title>
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="dark-mode-toggle-target">
    <header class="dark-mode-toggle-target">
        <div class="container">
            <div class="logo" style="max-width: 100px;">
                <img src="{{ asset('images/Logo-Light.jpg') }}" alt="Jejak Literasi Logo" id="logo" style="width: 100%; height: auto;" />
            </div>

            <nav>
                <form action="{{ route('books.search') }}" method="get" id="searchForm">
                    <div class="search-wrapper dark-mode-toggle-target">
                        <input type="text" placeholder="Search Books or Authors" name="q" id="searchInput" autocomplete="off" aria-label="Search Books or Authors">
                        <button type="submit" aria-label="Search">
                            <img src="{{ asset('images/search-icon.png') }}" alt="Search Icon">
                        </button>
                        <div id="suggestions" class="suggestions-box"></div>
                    </div>
                </form>
                <ul class="menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="dropdown">
                        <a href="{{ route('books.index') }}" class="dropbtn">Books</a>
                        <div class="dropdown-content">
                            <a href="{{ route('books.index') }}">All Books</a>
                            <a href="{{ route('books.category', 'all') }}">Categories</a>
                            <a href="{{ route('books.latest') }}">New Books</a>
                        </div>
                    </li>
                    <button class="dark-mode-toggle" aria-label="Toggle dark mode">
                    <span class="icon">🌙</span>
                </button>
                    @auth
                    <li class="user-dropdown">
    <a href="#" class="user-menu" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->username }} &#9662;</a>
    <ul class="user-dropdown-content">
        <li><a href="{{ route('cart.index') }}">Cart</a></li>
        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
        <li><a href="{{ route('profile.orders') }}">My Orders</a></li>
        <li><a href="{{ route('books.purchased') }}">My Books</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="logout-btn" aria-label="Logout">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</li>
@else
<li>
                        <div class="auth-toggle">
                            <a href="{{ route('register') }}" class="auth-option {{ request()->routeIs('register') ? 'active' : '' }}">Sign Up</a>
                            <a href="{{ route('login') }}" class="auth-option {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                        </div>
                    </li>
@endauth
                </ul>
            </nav>
        </div>
    </header>

    
    <main class="dark-mode-toggle-target">
        @yield('content')
    </main>

    <footer class="dark-mode-toggle-target">
        <div class="container">
            <p>&copy; {{ date('Y') }} Jejak Literasi. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
    <script>
    const logoDark = "{{ asset('images/Logo-Dark.jpg') }}";
    const logoLight = "{{ asset('images/Logo-Light.jpg') }}";
    </script>


        <script src="{{ asset('js/user.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
