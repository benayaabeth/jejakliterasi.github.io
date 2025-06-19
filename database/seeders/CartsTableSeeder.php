<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data untuk tabel carts
        Cart::create([
            'user_id' => 1, // Ganti dengan ID pengguna yang valid
            'book_id' => 1, // Ganti dengan ID buku yang valid
        ]);

        Cart::create([
            'user_id' => 1, // Ganti dengan ID pengguna yang valid
            'book_id' => 2, // Ganti dengan ID buku yang valid
        ]);

        // Tambahkan lebih banyak data sesuai kebutuhan
    }
}