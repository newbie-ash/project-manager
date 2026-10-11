<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rute Publik (Beranda & Katalog Koleksi)
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::resource('products', ProductController::class)->only(['index', 'show']);

// Static Pages
Route::get('/help-center', function () {
    return Inertia::render('HelpCenter');
})->name('help-center');
Route::get('/faq', function () {
    return Inertia::render('FAQ');
})->name('faq');

Route::middleware(['auth'])->group(function () {
    // Pengaturan Akun (Bisa diakses pembeli & admin)
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');

    // HANYA admin yang bisa mengakses Backoffice (Dashboard, Produk, Pesanan, dan Komplain)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/products', [DashboardController::class, 'products'])->name('admin.products.index');
        Route::resource('products', ProductController::class)->except(['index', 'show']);
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
        Route::patch('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
    });

    // Rute Keranjang Belanja & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/orders/{order}/mark-paid', [CheckoutController::class, 'markPaid'])->name('orders.mark_paid');

    // Rute untuk pembeli melakukan pesanan (legacy, mungkin dihapus nanti)
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Rute untuk pembeli membuat komplain (auth required to complain? No, let's keep it under auth)
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');

    // Rute untuk pembeli / user biasa melihat pesanannya sendiri
    Route::get('/my-purchases', [OrderController::class, 'myPurchases'])->name('purchases.index');
});
