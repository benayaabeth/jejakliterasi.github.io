<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ProfilePhotoController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('latest', [BookController::class, 'latest'])->name('books.latest');
Route::get('category/{category}', [BookController::class, 'category'])->name('books.category');
Route::get('search', [BookController::class, 'search'])->name('books.search');
Route::get('suggestions', [BookController::class, 'suggestions'])->name('books.suggestions');


// Authentication Routes
Auth::routes();

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes for managing books
    Route::resource('books', AdminBookController::class);

    // Resource routes for managing orders
    // Resource routes for managing orders
Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{order}/verify', [AdminOrderController::class, 'verify'])->name('orders.verify');
Route::post('/orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('orders.reject');
Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy'); // Tambahkan ini
    // Resource routes for managing users
    Route::resource('users', AdminUserController::class);
});

// User Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('checkout/status/{order}', [CheckoutController::class, 'checkStatus'])->name('checkout.status');

    // Profile & Orders
Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
    
    // Perbaiki path route (hapus /profile karena sudah dalam group prefix 'profile')
    Route::post('/photo/update', [ProfilePhotoController::class, 'update'])->name('photo.update');
    Route::get('/photo/{filename}', [ProfilePhotoController::class, 'show'])->name('photo.show');
});

    // Book Downloads
    Route::get('books/{book}/download', [BookController::class, 'download'])->name('books.download');

    // User's Purchased Books
    Route::get('my-books', [BookController::class, 'purchased'])->name('books.purchased');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/status/{order}', [CheckoutController::class, 'checkStatus'])->name('checkout.status');
});
