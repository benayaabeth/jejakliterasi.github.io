@extends('layouts.admin')

@section('content')
<div class="container px-6 mx-auto">
    <div class="flex justify-between items-center my-6">
        <h1 class="text-3xl font-semibold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Kembali
        </a>
    </div>

    <!-- Informasi Pesanan -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600">Nama Pelanggan</p>
                <p class="font-medium">{{ $order->user->name }}</p>
            </div>
            <div>
                <p class="text-gray-600">Email Pelanggan</p>
                <p class="font-medium">{{ $order->user->email }}</p>
            </div>
            <div>
                <p class="text-gray-600">Total Harga</p>
                <p class="font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-gray-600">Status</p>
                <span class="px-2 py-1 font-semibold text-sm rounded-full 
                    {{ $order->status === 'Pending' ? 'text-orange-700 bg-orange-100' : 'text-green-700 bg-green-100' }}">
                    {{ $order->status }}
                </span>
            </div>
            <div>
                <p class="text-gray-600">Tanggal Pesanan</p>
                <p class="font-medium">{{ $order->created_at }}</p>
            </div>
        </div>
    </div>

    <!-- Detail Pesanan -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Detail Produk</h2>
        <div class="overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                        <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">Harga Satuan</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($orderDetails as $detail)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    @if($detail->book->image)
                                        <img class="h-12 w-12 object-cover rounded" style="width: 150px;"
                                             src="{{ asset('storage/books/'.$detail->book->image) }}" 
                                             alt="{{ $detail->book->title }}">
                                    @endif
                                    <div class="ml-3">
                                        <p class="font-medium">{{ $detail->book->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $detail->book->author }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $detail->quantity }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900 border-t">
                        <td colspan="3" class="px-4 py-3 text-right">Total Keseluruhan:</td>
                        <td class="px-4 py-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Form Update Status -->
        <div class="mt-6 flex justify-end">
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="status" value="{{ $order->status === 'Pending' ? 'Selesai' : 'Pending' }}">
                <button type="submit" 
                        class="btn btn-sm btn-danger">
                    Ubah Status ke {{ $order->status === 'Pending' ? 'Selesai' : 'Pending' }}
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection