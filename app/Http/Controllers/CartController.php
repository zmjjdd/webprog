<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan produk dalam keranjang
    public function index()
    {
        $cart = Cart::with('products')->where('user_id', auth()->id())->first();
        if (!$cart) {
            $cart = Cart::create(['user_id' => auth()->id()]);
        }

        return view('carts.index', compact('cart'));
    }

    // Menambah produk ke keranjang
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cart->products()->attach($product->id, ['quantity' => 1]);

        return redirect()->route('cart.index');
    }

    // Menghapus produk dari keranjang
    public function removeFromCart($productId)
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $cart->products()->detach($productId);

        return redirect()->route('cart.index');
    }
}
