<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderDetails'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        Log::info('Show Order Details:', [
            'order_id' => $order->id,
            'session_key' => 'pending_order_details_' . $order->id,
            'session_data' => session('pending_order_details_' . $order->id)
        ]);

        if ($order->status === Order::STATUS_PENDING) {
            // Coba ambil dari temporary_order_details terlebih dahulu
            $tempOrderDetails = DB::table('temporary_order_details')
                ->where('order_id', $order->id)
                ->join('books', 'books.id', '=', 'temporary_order_details.book_id')
                ->select('temporary_order_details.*', 'books.*')
                ->get();

            if (!$tempOrderDetails->isEmpty()) {
                $orderDetails = $tempOrderDetails;
            } else {
                // Jika tidak ada di temporary, coba ambil dari order_details
                $orderDetails = $order->orderDetails()->with('book')->get();
                
                if ($orderDetails->isEmpty()) {
                    // Jika tidak ada di order_details, coba ambil dari session
                    $orderDetails = session('pending_order_details_' . $order->id);
                    
                    if (empty($orderDetails)) {
                        // Jika tidak ada di session, coba ambil dari cart
                        $orderDetails = Cart::where('user_id', $order->user_id)
                            ->with('book')
                            ->get()
                            ->map(function($item) {
                                return [
                                    'book_id' => $item->book_id,
                                    'price' => $item->book->price,
                                    'quantity' => $item->quantity,
                                    'book' => $item->book
                                ];
                            })
                            ->toArray();
                    }
                }
            }
        } else {
            // Jika sudah verified, ambil dari database
            $orderDetails = $order->orderDetails()->with('book')->get();
        }

        return view('admin.orders.show', compact('order', 'orderDetails'));
    }

    public function verify(Order $order)
    {
        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'This order cannot be verified.');
        }

        DB::beginTransaction();

        try {
            Log::info('Verifying Order:', [
                'order_id' => $order->id,
                'session_data' => session('pending_order_details_' . $order->id)
            ]);

            // Update status order menjadi verified
            $order->update(['status' => Order::STATUS_VERIFIED]);

            // Ambil order details yang sudah ada
            $orderDetails = $order->orderDetails()->with('book')->get();

            if ($orderDetails->isEmpty()) {
                // Coba ambil dari temporary_order_details
                $tempOrderDetails = DB::table('temporary_order_details')
                    ->where('order_id', $order->id)
                    ->get();

                if ($tempOrderDetails->isEmpty()) {
                    // Jika tidak ada di temporary, coba ambil dari session
                    $orderDetails = session('pending_order_details_' . $order->id);

                    if (empty($orderDetails)) {
                        // Jika tidak ada di session, coba ambil dari cart
                        $cartItems = Cart::where('user_id', $order->user_id)
                            ->with('book')
                            ->get();

                        if ($cartItems->isEmpty()) {
                            throw new \Exception('Order details not found in any source.');
                        }

                        $orderDetails = $cartItems->map(function($item) {
                            return [
                                'book_id' => $item->book_id,
                                'price' => $item->book->price,
                                'quantity' => $item->quantity
                            ];
                        })->toArray();
                    }
                } else {
                    // Gunakan data dari temporary table
                    $orderDetails = $tempOrderDetails->map(function($item) {
                        return [
                            'book_id' => $item->book_id,
                            'price' => $item->price,
                            'quantity' => $item->quantity
                        ];
                    })->toArray();
                }

                // Masukkan ke tabel order_details jika belum ada
                foreach ($orderDetails as $detail) {
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'book_id' => $detail['book_id'],
                        'price' => $detail['price'],
                        'quantity' => $detail['quantity']
                    ]);
                }
            }

            // Hapus data temporary dan session
            DB::table('temporary_order_details')->where('order_id', $order->id)->delete();
            session()->forget('pending_order_details_' . $order->id);
            Cart::where('user_id', $order->user_id)->delete();

            DB::commit();
            return redirect()->route('admin.orders.index')
                           ->with('success', 'Order has been verified successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Verify Order Error:', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Failed to verify order: ' . $e->getMessage());
        }
    }

    public function reject(Order $order)
    {
        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'This order cannot be rejected.');
        }

        DB::beginTransaction();

        try {
            $order->update(['status' => Order::STATUS_REJECTED]);
            session()->forget('pending_order_details_' . $order->id);
            Cart::where('user_id', $order->user_id)->delete();

            DB::commit();
            return redirect()->route('admin.orders.index')
                           ->with('success', 'Order has been rejected');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Reject Order Error:', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to reject order: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (!in_array($request->status, Order::$validStatuses)) {
            return back()->with('error', 'Invalid status.');
        }

        DB::beginTransaction();

        try {
            if ($request->status === Order::STATUS_COMPLETED && $order->status === Order::STATUS_PENDING) {
                // Ambil order details yang sudah ada
                $orderDetails = $order->orderDetails()->with('book')->get();

                if ($orderDetails->isEmpty()) {
                    throw new \Exception('Order details not found.');
                }
            }

            $order->update(['status' => $request->status]);

            DB::commit();
            return redirect()->route('admin.orders.index')
                           ->with('success', 'Order status has been updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update Status Error:', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to update order status: ' . $e->getMessage());
        }
    }

    public function destroy(Order $order)
    {
        DB::beginTransaction();

        try {
            if ($order->status !== Order::STATUS_PENDING) {
                $order->orderDetails()->delete();
            } else {
                session()->forget('pending_order_details_' . $order->id);
                Cart::where('user_id', $order->user_id)->delete();
            }

            $order->delete();

            DB::commit();
            return redirect()->route('admin.orders.index')
                           ->with('success', 'Order has been deleted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete Order Error:', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }
}