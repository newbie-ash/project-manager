<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        // Admin: Show all orders
        $orders = Order::with(['user', 'product'])->latest()->get()->map(function($order) {
            return [
                'database_id' => $order->id, // Real database ID needed for updating
                'id' => $order->order_number,
                'customer' => $order->user->name,
                'date' => $order->created_at->format('Y-m-d'),
                'status' => $order->status,
                'total' => $order->total_price
            ];
        });

        return Inertia::render('Admin/Orders', [
            'orders' => $orders
        ]);
    }

    public function myPurchases()
    {
        // Buyer: Show only their own orders
        $purchases = Order::with(['product'])->where('user_id', auth()->id())->latest()->get()->map(function($order) {
            return [
                'id' => $order->order_number,
                'date' => $order->created_at->format('Y-m-d'),
                'status' => $order->status,
                'items' => $order->product ? $order->product->name : 'Deleted Product',
                'total' => $order->total_price
            ];
        });

        return Inertia::render('Buyer/MyPurchases', [
            'purchases' => $purchases
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(6)),
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'status' => 'Processing',
            'total_price' => $product->price
        ]);

        return redirect()->route('purchases.index')->with('success', 'Pre-order placed successfully.');
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('message', 'Order status updated successfully.');
    }
}
