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
Route::get('/help-center', function () { return \Inertia\Inertia::render('HelpCenter'); })->name('help-center');
Route::get('/faq', function () { return \Inertia\Inertia::render('FAQ'); })->name('faq');

Route::middleware(['auth'])->group(function () {
    // Pengaturan Akun (Bisa diakses user, staff, admin)
    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [\App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('settings.profile.update');

    // HANYA admin yang bisa menambah, dan menghapus produk secara permanen, serta melihat dashboard admin utama
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class)->only(['create', 'store', 'destroy']);
    });

    // Admin & Staff bisa mengakses Katalog Koleksi (Backoffice), Edit Produk (Update Stok), Pesanan, dan Komplain
    Route::middleware(['role:staff,admin'])->group(function () {
        Route::get('/admin/products', [\App\Http\Controllers\DashboardController::class, 'products'])->name('admin.products.index');
        Route::resource('products', ProductController::class)->only(['edit', 'update']);
        Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
        Route::get('/complaints', [\App\Http\Controllers\ComplaintController::class, 'index'])->name('complaints.index');
        Route::patch('/complaints/{complaint}', [\App\Http\Controllers\ComplaintController::class, 'update'])->name('complaints.update');
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

// ==============================
// Staff‑only routes (admin can also access)
// ==============================
Route::middleware(['auth', 'role:staff,admin'])->group(function () {
    Route::get('/staff/dashboard', [\App\Http\Controllers\StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('/staff/reports', [\App\Http\Controllers\StaffController::class, 'reports'])->name('staff.reports');
    Route::get('/staff/sales-stats', [\App\Http\Controllers\StaffController::class, 'salesStats'])->name('staff.sales_stats');
    Route::get('/staff/stock-management', [\App\Http\Controllers\StaffController::class, 'stockManagement'])->name('staff.stock_management');
});
