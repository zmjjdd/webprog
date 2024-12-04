@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-10">
        <!-- Detail Produk Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Gambar Produk -->
            <div class="relative">
                <img src="{{ asset('storage/' . $product->image_url) }}" class="object-cover rounded-lg shadow-lg w-full h-80"
                    alt="{{ $product->product_name }}">

                <!-- Label Hot Item -->
                @if ($product->is_hot_item)
                    <div
                        class="absolute top-0 left-0 m-3 bg-red-600 text-white px-4 py-2 rounded-full text-xs font-semibold">
                        Hot Item
                    </div>
                @endif
            </div>

            <!-- Deskripsi Produk -->
            <div>
                <h2 class="text-3xl font-semibold text-gray-800">{{ $product->product_name }}</h2>
                <p class="text-gray-600 mt-4">{{ $product->description }}</p>

                <div class="mt-6">
                    <p class="text-xl text-red-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="btn btn-success w-full py-3 px-6 text-lg font-semibold text-white bg-green-500 hover:bg-green-600 rounded-lg">
                        Add to Cart
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
