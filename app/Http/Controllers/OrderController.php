<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Memproses checkout dan membuat order
    public function checkout()
    {
        $cart = Cart::with('products')->where('user_id', auth()->id())->first();
        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $cart->totalPrice(),
        ]);

        // Tambahkan produk ke order
        foreach ($cart->products as $product) {
            $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);
        }

        // Reset keranjang setelah checkout
        $cart->products()->detach();

        return redirect()->route('order.confirmation', $order->id);
    }

    // Menampilkan halaman konfirmasi setelah checkout
    public function confirmation($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('orders.confirmation', compact('order'));
    }
}
