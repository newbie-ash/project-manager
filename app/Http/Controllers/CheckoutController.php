<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
// use Midtrans\Config;
// use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:carts,id'
        ]);

        $userId = auth()->id();
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->whereIn('id', $request->selected_items)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada barang yang dipilih.');
        }

        $totalPrice = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // Buat Pesanan (Order)
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => $userId,
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone,
            'status' => 'Unpaid',
            'total_price' => $totalPrice
        ]);

        // Pindahkan dari Cart ke OrderItem
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Hapus HANYA isi keranjang yang telah di-checkout
        Cart::where('user_id', $userId)
            ->whereIn('id', $request->selected_items)
            ->delete();

        // ----------------------------------------------------
        // INTEGRASI MIDTRANS SNAP
        // ----------------------------------------------------
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
        
        // Untuk local development Windows agar tidak error cURL SSL
        if (app()->environment('local')) {
            \Midtrans\Config::$curlOptions = [
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTPHEADER => []
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => $request->phone,
                'billing_address' => [
                    'address' => $request->shipping_address,
                ],
                'shipping_address' => [
                    'address' => $request->shipping_address,
                ]
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            // Jika gagal mendapatkan token, biarkan pesanan terbuat tanpa token
            // User nanti bisa mencoba bayar ulang.
        }

        return redirect()->route('purchases.index')->with('success', 'Pesanan berhasil dibuat. Menunggu pembayaran.');
    }

    public function markPaid(Order $order)
    {
        // Pastikan hanya pemilik yang bisa menandai (atau gunakan webhook asli jika live)
        if ($order->user_id === auth()->id() && $order->status === 'Unpaid') {
            $order->update(['status' => 'Processing']);
        }
        return redirect()->route('purchases.index')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
