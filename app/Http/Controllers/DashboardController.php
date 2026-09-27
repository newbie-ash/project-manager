<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = \App\Models\Order::count();
        
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'customers' => 24, // Mock
                'products' => $totalProducts,
                'new_orders' => 5, // Mock
                'transactions' => $totalOrders, 
            ]
        ]);
    }

    public function products()
    {
        $products = Product::latest()->get();
        return Inertia::render('Admin/Products', [
            'products' => $products
        ]);
    }
}
