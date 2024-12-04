<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function dashboard()
    {
        // Menampilkan dashboard penjual
        $products = Product::where('user_id', auth()->id())->get();
        return view('sellers.dashboard', compact('products'));
    }

    public function createStore(Request $request)
    {
        // Membuat toko baru
        $request->validate([
            'store_name' => 'required',
            'store_description' => 'nullable',
        ]);

        $store = Store::create([
            'user_id' => auth()->id(),
            'store_name' => $request->store_name,
            'store_description' => $request->store_description,
        ]);

        return redirect()->route('sellers.dashboard')->with('success', 'Store created successfully!');
    }

    public function updateStore(Request $request, $id)
    {
        // Memperbarui informasi toko
        $store = Store::where('user_id', auth()->id())->findOrFail($id);
        $store->update($request->all());

        return redirect()->route('sellers.dashboard')->with('success', 'Store updated successfully!');
    }
}
