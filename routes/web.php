<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::middleware(['auth'])->group(function () {
    // HANYA admin yang bisa menambah, mengubah, dan menghapus produk
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
        Route::resource('products', ProductController::class)->except(['index', 'show']);
    });

    // Semua user (admin & staff) bisa melihat produk
    Route::resource('products', ProductController::class)->only(['index', 'show']);
});
