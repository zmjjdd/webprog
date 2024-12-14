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
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        return view('carts.index', compact('cart'));
    }

    // Menambah produk ke keranjang
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        // Cek apakah produk sudah ada di keranjang user
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            // Jika sudah ada, tambahkan quantity
            $cart->quantity += 1;
            $cart->save();
        } else {
            // Jika belum ada, buat entri baru
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }


    // Menghapus produk dari keranjang
    public function removeFromCart($productId)
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $cart->products()->detach($productId);

        return redirect()->route('cart.index');
    }
}
