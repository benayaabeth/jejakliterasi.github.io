@extends('layouts.user')

@section('title', 'My Orders - Jejak Literasi')

@push('styles')
<link href="{{ asset('css/user.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
<main>

    <section class="transactions">
        <h2 class="orders-title">My Orders History</h2>
        <div class="container">

            @if(count($orders) > 0)
                <div class="orders-wrapper">
                    @foreach($orders as $order)
                        <div class="card order-item mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">Order #{{ $order->id }}</span>
                                    <span class="text-muted ms-3">
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}
                                    </span>
                                </div>
                                <div>
                                    <span class="status-badge status-{{ strtolower($order->status) }}">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="transaction-table">
                                        <thead>
                                            <tr>
                                                <th width="120">Book</th>
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th width="100">Quantity</th>
                                                <th width="150" class="text-end">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->orderDetails as $detail)
                                                <tr>
                                                    <td>
                                                        @if($detail->book->image)
                                                            <img class="book-thumbnail" 
                                                                src="{{ asset('storage/books/'.$detail->book->image) }}" 
                                                                alt="{{ $detail->book->title }}">
                                                        @endif
                                                    </td>
                                                    <td>{{ $detail->book->title }}</td>
                                                    <td>{{ $detail->book->author }}</td>
                                                    <td class="text-center">{{ $detail->quantity }}</td>
                                                    <td class="text-end">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-end fw-bold">Total:</td>
                                                <td class="text-end fw-bold">
                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                                @if($order->status == 'verified' || $order->status == 'Selesai')
                                    <div class="mt-3 download-section">
                                        @foreach($order->orderDetails as $detail)
                                            <a href="{{ route('books.download', $detail->book) }}" 
                                            class="download-btn">
                                                <i class="bi bi-download me-2"></i>
                                                Download {{ $detail->book->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>
                    <p class="mb-0">You don't have any orders yet.</p>
                </div>
            @endif
        </div>
    </section>
</main>

<div class="loading-spinner" style="display: none;">
    <div class="spinner"></div>
</div>
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
    
    // Loading state for downloads
    const downloadButtons = document.querySelectorAll('.download-btn');
    const loadingSpinner = document.querySelector('.loading-spinner');
    
    downloadButtons.forEach(button => {
        button.addEventListener('click', function() {
            loadingSpinner.style.display = 'flex';
            
            // Hide spinner after download starts (approx. 1 second)
            setTimeout(() => {
                loadingSpinner.style.display = 'none';
            }, 1000);
        });
    });
});
</script>
@endpush
