<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Auth\AuthController;

// Tampilan Awal
Route::get('/', [ProductController::class, 'index'])->name('home'); // Landing Page

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// Route untuk membuat produk baru
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route untuk menyimpan produk baru
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Route untuk mengedit produk
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Route untuk memperbarui produk
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Route untuk menghapus produk
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
// Keranjang
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/{productId}/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/{productId}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

// Pesanan
Route::prefix('orders')->group(function () {
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout'); // Halaman checkout
    Route::get('/{orderId}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation'); // Konfirmasi pesanan
});

// Penjual (Dashboard & Toko)
Route::prefix('seller')->group(function () {
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('sellers.dashboard'); // Dashboard Penjual
    Route::post('/store', [SellerController::class, 'createStore'])->name('store.create'); // Membuat toko
    Route::put('/store/{id}', [SellerController::class, 'updateStore'])->name('store.update'); // Update toko
});

Route::middleware(['auth'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
});


// Autentikasi
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Default Routes untuk Autentikasi (Laravel Breeze / Fortify / Auth)
Auth::routes();
