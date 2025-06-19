@extends('layouts.admin')

@section('content')
<div class="container px-6 mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 my-6">Daftar Pesanan</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Pelanggan</th>
                        <th class="px-4 py-3">Total Harga</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach($orders as $order)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->user->name }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-semibold leading-tight rounded-full 
                                    @if($order->status === 'Pending')
                                        text-orange-700 bg-orange-100
                                    @elseif($order->status === 'verified')
                                        text-blue-700 bg-blue-100
                                    @elseif($order->status === 'rejected')
                                        text-red-700 bg-red-100
                                    @else
                                        text-green-700 bg-green-100
                                    @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $order->created_at }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <!-- Detail Button -->
                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                       class="inline-flex items-center px-1.5 py-1 text-xs font-medium text-blue-600 hover:text-blue-700 rounded">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span class="ml-1">Detail</span>
                                    </a>

                                    @if($order->status === 'Pending')
                                        <!-- Verify Button -->
                                        <form action="{{ route('admin.orders.verify', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-1.5 py-1 text-xs font-medium text-green-600 hover:text-green-700 rounded"
                                                    onclick="return confirm('Are you sure you want to verify this order?')">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="ml-1">Verify</span>
                                            </button>
                                        </form>

                                        <!-- Reject Button -->
                                        <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-1.5 py-1 text-xs font-medium text-red-600 hover:text-red-700 rounded"
                                                    onclick="return confirm('Are you sure you want to reject this order?')">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                <span class="ml-1">Reject</span>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Update Status Button -->
                                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" 
                                               value="{{ $order->status === 'Pending' ? 'Selesai' : 'Pending' }}">
                                        <button type="submit" 
                                                class="inline-flex items-center px-1.5 py-1 text-xs font-medium text-yellow-600 hover:text-yellow-700 rounded">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            <span class="ml-1">Update</span>
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" 
                                          method="POST" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this order?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-1.5 py-1 text-xs font-medium text-red-600 hover:text-red-700 rounded">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span class="ml-1">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t bg-gray-50">
            {{ $orders->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
        </div>
    </div>
</div>
@endsection