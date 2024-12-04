<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman home dengan produk populer atau terbaru.
     */
    // Di ProductController
    public function index(Request $request)
    {
        // Query awal untuk produk
        $products = Product::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $products->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $products->where('category_id', $request->category);
        }

        // Ambil semua kategori untuk dropdown
        $categories = Category::all();

        // Dapatkan 12 produk terbaru
        $products = $products->orderBy('created_at', 'desc')->take(12)->get();

        return view('home', compact('products', 'categories'));
    }


    /**
     * Menampilkan semua produk dengan pagination.
     */
    public function allProducts(Request $request)
    {
        $products = Product::query();

        if ($request->has('search')) {
            $products->where('product_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $products->where('category_id', $request->category);
        }

        $products = $products->paginate(12); // Pagination 12 item per halaman

        $categories = Category::all(); // Ambil semua kategori

        return view('product.index', compact('products', 'categories'));
    }

    /**
     * Menampilkan detail produk.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id); // Temukan produk berdasarkan ID

        return view('product.show', compact('product'));
    }

    /**
     * Menampilkan form untuk menambah produk baru.
     */
    public function create()
    {
        $categories = Category::all();

        return view('sellers.create_product', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');
        }

        Product::create([
            'user_id' => auth()->id(), // Ambil user_id dari pengguna yang login
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }





    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Pastikan ada kategori
        return view('sellers.edit_product', compact('product', 'categories'));
    }


    /**
     * Memperbarui data produk.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imagePath = $product->image_url; // Gunakan gambar lama jika tidak ada yang baru
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');
        }

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil diperbarui!');
    }



    /**
     * Menghapus produk.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard')->with('success', 'Product deleted successfully!');
    }
}
