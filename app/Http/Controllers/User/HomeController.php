<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Mendapatkan semua buku dan menghitung pembelian jika ada
        $popularBooks = Book::select('books.*')
            ->selectRaw('COALESCE(SUM(CASE 
                WHEN orders.status IN ("verified", "Selesai") 
                THEN order_details.quantity 
                ELSE 0 
                END), 0) as total_purchased')
            ->leftJoin('order_details', 'books.id', '=', 'order_details.book_id')
            ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->groupBy(
                'books.id',
                'books.title',
                'books.author',
                'books.synopsis',
                'books.kategori',
                'books.price',
                'books.image',
                'books.pdf_file',
                'books.created_at',
                'books.updated_at'
            )
            ->orderBy('total_purchased', 'desc')
            ->limit(6)
            ->get();

        // Mendapatkan 8 buku terbaru
        $latestBooks = Book::latest('created_at')
            ->limit(6)
            ->get();

        // Mendapatkan 8 buku random
        $randomBooks = Book::inRandomOrder()
            ->limit(6)
            ->get();

        return view('user.home', compact('popularBooks', 'latestBooks', 'randomBooks'));
    }
}