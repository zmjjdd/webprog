@extends('layouts.app')

@section('title', 'Preloved - Jual Beli Barang Thrift')

@section('content')
    <div class="container mt-5">
        <!-- Hero Section -->
        <div class="bg-black text-white py-5">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <h1 class="fw-bold">Jual-Beli Barang Preloved dan Thrift</h1>
                        <p class="lead">Dapatkan produk berkualitas dengan harga terjangkau.</p>
                        <div class="mt-4">
                            @auth
                                <a href="{{ route('seller.dashboard') }}" class="btn btn-primary btn-lg px-4">Mulai Berjualan</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">Mulai Berjualan</a>
                            @endauth
                            <a href="#" class="btn btn-outline-light btn-lg px-4">Cara Kerjanya</a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="https://images.unsplash.com/photo-1522724514897-24b0eb7ba3ea?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Hero Image" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Terbaru -->
        <div class="my-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-center mb-4">Produk Terbaru</h2>
                <form action="{{ route('home') }}" method="GET" class="d-inline-block">
                    <label for="category" class="form-label me-2">Filter Kategori:</label>
                    <select name="category" class="form-control d-inline-block w-auto" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="row mt-4">
                @foreach ($products as $product)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top"
                                alt="{{ $product->product_name }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title fw-bold text-truncate">{{ $product->product_name }}</h6>
                                <p class="card-text mb-1 text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <small class="text-muted d-block">{{ $product->brand ?? 'Unknown' }} -
                                    {{ $product->size ?? 'Other' }}</small>
                                <a href="{{ route('product.show', $product->id) }}"
                                    class="btn btn-dark btn-sm mt-2 w-100">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="mb-5">
            <h2 class="fw-bold">Hot Items</h2>
            <div class="row">
                @foreach ($products as $product)
                    @if ($product->is_hot_item)
                        {{-- Pastikan ada field/flag untuk Hot Items --}}
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                {{-- Cek jika image_url tidak ada, gunakan gambar kosong --}}
                                <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : 'https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                                    class="card-img-top" alt="{{ $product->product_name }}"
                                    style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold text-truncate">{{ $product->product_name }}</h6>
                                    <p class="card-text mb-1 text-muted">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <small class="text-muted d-block">{{ $product->brand ?? 'Unknown' }} -
                                        {{ $product->size ?? 'Other' }}</small>
                                    <a href="{{ route('product.show', $product->id) }}"
                                        class="btn btn-dark btn-sm mt-2 w-100">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>



        <!-- Section: Belanja Sesuai Budget -->
        <div class="mb-5">
            <h2 class="fw-bold">Belanja Sesuai Budget</h2>
            <div class="row text-center mt-4">
                <div class="col-md-3">
                    <div class="border py-3 shadow-sm budget-box">
                        <h6 class="fw-bold">Di bawah 100Rb</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border py-3 shadow-sm budget-box">
                        <h6 class="fw-bold">100Rb - 250Rb</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border py-3 shadow-sm budget-box">
                        <h6 class="fw-bold">250Rb - 500Rb</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border py-3 shadow-sm budget-box">
                        <h6 class="fw-bold">Di atas 500Rb</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
