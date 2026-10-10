<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StaffController extends Controller
{
    public function dashboard()
    {
        // Mengambil data statistik untuk dashboard
        $totalComplaints = Complaint::count();
        $totalSales = Order::where('status', '!=', 'cancelled')->sum('total_price');
        $totalProducts = Product::count();

        return Inertia::render('Staff/Dashboard', [
            'stats' => [
                'reports' => $totalComplaints,
                'sales' => 'Rp ' . number_format($totalSales, 0, ',', '.'),
                'stock' => $totalProducts,
            ]
        ]);
    }

    public function reports()
    {
        // Mengambil data laporan/komplain
        $complaints = Complaint::latest()->get();
        return Inertia::render('Staff/Reports', [
            'complaints' => $complaints
        ]);
    }

    public function salesStats()
    {
        // Mengambil data statistik penjualan
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_price');
        $recentOrders = Order::with('user')->latest()->take(10)->get();

        return Inertia::render('Staff/SalesStats', [
            'stats' => [
                'total_orders' => $totalOrders,
                'total_revenue' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
            ],
            'recent_orders' => $recentOrders
        ]);
    }

    public function stockManagement()
    {
        // Mengambil data stok produk, diurutkan dari stok yang paling sedikit
        $products = Product::orderBy('stock', 'asc')->get();
        return Inertia::render('Staff/StockManagement', [
            'products' => $products
        ]);
    }
}
