<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function process()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('book')
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        DB::beginTransaction();

        try {
            // Hitung total harga
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->book->price * $item->quantity;
            });

            // Buat order dengan status 'Pending'
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'status' => 'Pending',
                'created_at' => now()
            ]);

            // Simpan order details ke order_details table
            foreach ($cartItems as $item) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'price' => $item->book->price,
                    'quantity' => $item->quantity
                ]);
            }

            // Simpan juga ke temporary table sebagai backup
            foreach ($cartItems as $item) {
                DB::table('temporary_order_details')->insert([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'price' => $item->book->price,
                    'quantity' => $item->quantity,
                    'created_at' => now()
                ]);
            }

            // Simpan detail order ke session sebagai backup tambahan
            $orderDetails = $cartItems->map(function($item) {
                return [
                    'book_id' => $item->book_id,
                    'price' => $item->book->price,
                    'quantity' => $item->quantity,
                    'book' => $item->book
                ];
            })->toArray();
            
            session(['pending_order_details_' . $order->id => $orderDetails]);

            // Hapus cart setelah order dibuat
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return view('user.checkout.success', [
                'order' => $order,
                'message' => 'Your order has been placed and is waiting for verification.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('cart.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}