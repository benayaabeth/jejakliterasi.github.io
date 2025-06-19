@extends('layouts.user')

@section('title', 'My Orders')

@section('content')
<main>
    <section class="transactions">
        <div class="container">
            <h2>Order History</h2>
            
            @if($orders->count() > 0)
                <table class="transaction-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Order Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ str_pad($loop->iteration, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->created_at->format('d F Y H:i') }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($order->status) }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <table class="detail-table">
                                        <thead>
                                            <tr>
                                                <th>Book Title</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->orderDetails as $detail)
                                                <tr>
                                                    <td>{{ $detail->book->title }}</td>
                                                    <td>{{ $detail->quantity }}</td>
                                                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No orders found.</p>
            @endif
        </div>
    </section>
</main>
@endsection