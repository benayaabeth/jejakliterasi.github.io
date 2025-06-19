@extends('layouts.user')

@section('title', 'Shopping Cart')

@section('content')
<head>
    <!-- other head elements -->
    @stack('scripts')

<style>
    /* Halaman Keranjang Belanja */
.page-title {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2rem;
    color: #333;
}

/* Tabel Keranjang */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    font-size: 1rem;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

.table th {
    background-color: #f8f9fa;
    font-weight: bold;
    text-transform: uppercase;
    color: #555;
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table img {
    border-radius: 4px;
}

/* Tombol */
.btn {
    display: inline-block;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9rem;
    text-transform: uppercase;
    transition: background-color 0.3s, color 0.3s;
}

.btn-primary {
    background-color: #0d6efd;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-danger:hover {
    background-color: #a71d2a;
}

/* Informasi Checkout */
.checkout-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f8f9fa;
    margin-top: 20px;
}

.checkout-info p {
    font-size: 1.2rem;
    font-weight: bold;
    margin: 0;
    color: #333;
}
/* Dark mode styles */
body.dark-mode {
    background-color: #1a1a1a;
    color: #ffffff;
}

body.dark-mode .page-title h2 {
    color: #ffffff;
}

body.dark-mode .table {
    color: #ffffff;
}

body.dark-mode .table th,
body.dark-mode .table td {
    border-color: #404040;
}

body.dark-mode .table th {
    background-color: #2d2d2d;
    color: #ffffff;
}

body.dark-mode .table tbody tr:nth-child(even) {
    background-color: #2d2d2d;
}

body.dark-mode .checkout-info {
    background-color: #2d2d2d;
    border-color: #404040;
    color: #ffffff;
}

body.dark-mode .checkout-info p {
    color: #ffffff;
}

/* Add smooth transitions */
body {
    transition: background-color var(--transition-speed, 0.3s),
                color var(--transition-speed, 0.3s);
}

.table,
.table th,
.table td,
.checkout-info {
    transition: background-color var(--transition-speed, 0.3s),
                border-color var(--transition-speed, 0.3s),
                color var(--transition-speed, 0.3s);
}
/* Dark mode styles */
body.dark-mode {
    background-color: #1a1a1a;
    color: #ffffff;
}

/* Add this style for the cart header section */
body.dark-mode main {
    background-color: #1a1a1a;
}

/* Add this for the page title section that has white background */
body.dark-mode .page-title {
    background-color: #1a1a1a;
}


</style>
</head>
<div class="page-title">
    <h2>Your Cart</h2>
</div>

<main>
    <div class="container">
        @if($cartItems->count() > 0)
            <!-- Shopping Cart Table -->
            <table class="table table-bordered table-striped" aria-labelledby="cartTable">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Book Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php
                            $total += $item->book->price * $item->quantity;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset('storage/books/'.$item->book->image) }}" 
                                     alt="Cover of {{ $item->book->title }}" 
                                     width="50" 
                                     class="img-fluid">
                            </td>
                            <td>{{ $item->book->title }}</td>
                            <td>Rp {{ number_format($item->book->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->book_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total and Checkout Form -->
            <div class="checkout-info">
                <p><strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            </div>
        @else
            <p>Your cart is empty. <a href="{{ route('books.index') }}">Shop Now</a></p>
        @endif
    </div>
</main>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add dark mode support
    const body = document.body;
    const darkModeToggle = document.getElementById('darkModeToggle');
    
    function applyDarkMode() {
        // Add smooth transition for all color changes
        document.documentElement.style.setProperty('--transition-speed', '0.3s');
        body.classList.add('dark-mode');
    }
    
    function removeDarkMode() {
        body.classList.remove('dark-mode');
    }
    
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            
            // Store preference
            const isDarkMode = body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
        });
    }
    
    // Check for saved dark mode preference
    const savedDarkMode = localStorage.getItem('darkMode');
    if (savedDarkMode === 'true') {
        applyDarkMode();
    }
    
    // Check system preference
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && !localStorage.getItem('darkMode')) {
        applyDarkMode();
    }
    
    // Watch for system dark mode changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('darkMode')) {
            if (e.matches) {
                applyDarkMode();
            } else {
                removeDarkMode();
            }
        }
    });
});
</script>
@endpush