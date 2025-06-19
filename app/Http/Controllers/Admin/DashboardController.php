<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('level', 'user')->count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        
        return view('admin.dashboard', compact(
            'totalBooks',
            'totalOrders',
            'totalUsers',
            'pendingOrders'
        ));
    }
}
