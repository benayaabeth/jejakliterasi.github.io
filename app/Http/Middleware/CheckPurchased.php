<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPurchased
{
    public function handle(Request $request, Closure $next)
    {
        // Mengambil parameter book dari route
        $book = $request->route('book');  

        // Cek apakah pengguna yang terautentikasi telah membeli buku tersebut
        if (!auth()->check() || !auth()->user()->hasPurchased($book)) {
            // Redirect kembali dengan pesan error jika pengguna belum membeli buku
            return redirect()->back()->with('error', 'You need to purchase this book first.');
        }

        // Melanjutkan permintaan ke aksi/controller berikutnya
        return $next($request);
    }
}
