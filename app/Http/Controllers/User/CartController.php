<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart; // Pastikan model Cart diimport
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        // Ambil cart items untuk user yang login
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('book')
            ->get();

        return view('user.cart.index', ['cartItems' => $cartItems]);
    }

    public function add(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id'
    ]);

    $book = Book::findOrFail($request->book_id);
    
    // Cek apakah buku sudah dibeli dan tidak direject
    $purchased = Order::where('user_id', auth()->id())
        ->whereIn('status', ['verified', 'Selesai', 'Pending'])
        ->whereHas('orderDetails', function ($query) use ($book) {
            $query->where('book_id', $book->id);
        })
        ->exists();

    if ($purchased) {
        return redirect()->back()->with('error', 'You already own this book.');
    }

    // Cek apakah buku sudah ada di cart
    $existingCartItem = Cart::where('user_id', auth()->id())
        ->where('book_id', $book->id)
        ->first();

    if ($existingCartItem) {
        return redirect()->back()->with('error', 'This book is already in your cart.');
    }

    try {
        DB::beginTransaction();
        Cart::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'quantity' => 1
        ]);
        DB::commit();
        return redirect()->route('cart.index')->with('success', 'Book added to cart successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Failed to add book to cart. Please try again.');
    }
}

    public function remove($id)
    {
        try {
            Cart::where('user_id', auth()->id())
                ->where('book_id', $id)
                ->delete();

            return redirect()->route('cart.index')->with('success', 'Book removed from cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove book from cart.');
        }
    }

    public function clear()
    {
        try {
            Cart::where('user_id', auth()->id())->delete();
            return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to clear cart.');
        }
    }
}