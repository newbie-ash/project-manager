<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        // Dummy data for presentation
        $orders = [
            [
                'id' => 'ORD-001',
                'customer' => 'Eleanor Roosevelt',
                'date' => '2026-09-27',
                'status' => 'Processing',
                'total' => 35000000.00
            ],
            [
                'id' => 'ORD-002',
                'customer' => 'John F. Kennedy',
                'date' => '2026-09-26',
                'status' => 'Shipped',
                'total' => 12000000.00
            ],
            [
                'id' => 'ORD-003',
                'customer' => 'Audrey Hepburn',
                'date' => '2026-09-25',
                'status' => 'Delivered',
                'total' => 125000000.00
            ],
            [
                'id' => 'ORD-004',
                'customer' => 'Grace Kelly',
                'date' => '2026-09-25',
                'status' => 'Pending',
                'total' => 8500000.00
            ],
        ];

        return Inertia::render('Admin/Orders', [
            'orders' => $orders
        ]);
    }
}
