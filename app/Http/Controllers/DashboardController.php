<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Mock data for the dashboard since we only have Products model fully implemented
        $totalProducts = Product::count();
        
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'customers' => 24, // Mock
                'products' => $totalProducts,
                'new_orders' => 5, // Mock
                'transactions' => 128, // Mock
            ]
        ]);
    }
}
