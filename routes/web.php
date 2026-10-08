<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rute Publik (Beranda & Katalog Koleksi)
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::resource('products', ProductController::class)->only(['index', 'show']);

// Static Pages
Route::get('/settings', function () { return \Inertia\Inertia::render('Settings'); })->name('settings');
Route::get('/help-center', function () { return \Inertia\Inertia::render('HelpCenter'); })->name('help-center');
Route::get('/faq', function () { return \Inertia\Inertia::render('FAQ'); })->name('faq');

Route::middleware(['auth'])->group(function () {
    // HANYA admin yang bisa menambah, mengubah, dan menghapus produk
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/products', [\App\Http\Controllers\DashboardController::class, 'products'])->name('admin.products.index');
        Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
        Route::get('/complaints', [\App\Http\Controllers\ComplaintController::class, 'index'])->name('complaints.index');
        Route::patch('/complaints/{complaint}', [\App\Http\Controllers\ComplaintController::class, 'update'])->name('complaints.update');
        Route::resource('products', ProductController::class)->except(['index', 'show']);
    });

    // Rute Keranjang Belanja & Checkout
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/orders/{order}/mark-paid', [\App\Http\Controllers\CheckoutController::class, 'markPaid'])->name('orders.mark_paid');

    // Rute untuk pembeli melakukan pesanan (legacy, mungkin dihapus nanti)
    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    
    // Rute untuk pembeli membuat komplain (auth required to complain? No, let's keep it under auth)
    Route::post('/complaints', [\App\Http\Controllers\ComplaintController::class, 'store'])->name('complaints.store');

    // Rute untuk pembeli / user biasa melihat pesanannya sendiri
    Route::get('/my-purchases', [\App\Http\Controllers\OrderController::class, 'myPurchases'])->name('purchases.index');
});
