@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Dashboard Admin</h1>

    <div class="row">
        <!-- Card Statistik Total Buku -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Buku</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBooks }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Statistik Total Pesanan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Statistik Total Pengguna -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <div class="flex items-center">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Pengguna</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Card Statistik Pesanan Pending -->
        <div class="p-4 bg-white rounded-lg shadow-md">
            <div class="flex items-center">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Pesanan Pending</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $pendingOrders }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection