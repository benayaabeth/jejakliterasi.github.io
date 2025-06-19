@extends('layouts.user')

@section('title', 'Checkout Success')

@push('styles')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
@endpush
<style>
    .save-button {
        background-color: #28a745;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .save-button:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .save-button.bg-secondary {
        background-color: #6c757d;
    }

    .save-button.bg-secondary:hover {
        background-color: #5a6268;
    }

    .auth-form a {
        color: rgb(0, 0, 0);
        text-decoration: none;
    }

    .qr-code-container {
        text-align: center;
        margin-top: 20px;
    }

    .qr-code-container img {
        max-width: 200px;
        height: auto;
    }
</style>
@section('content')
<main>
    <section class="transactions">
        <div class="container">
            <div class="auth-form">
                <h2>Your Order Has Been Created</h2>
                <div class="alert alert-info">
                    <h4 class="fw-bold mb-3">Payment Information</h4>
                    <div class="detail-table">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Account Number:</strong></td>
                                <td>0895347394794 (Dana)</td>
                            </tr>
                            <tr>
                                <td><strong>Total Payment:</strong></td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                        <div class="qr-code-container">
                            <img src="images/qr_code.jpeg" alt="QR Code"/>
                        </div>
                        <p class="text-center mt-3">After payment, please wait for admin confirmation.</p>
                    </div>
                    <hr>
                </div>
                
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('home') }}" class="save-button bg-secondary">Back to Home</a>
                    <a href="{{ route('profile.orders') }}" class="save-button">Check My Orders</a>
                </div>
            </div>
        </div>
    </section>

    <div class="loading-spinner" style="display: none;"></div>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/user.js') }}"></script>
@endpush