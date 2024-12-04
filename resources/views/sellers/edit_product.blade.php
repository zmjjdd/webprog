@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Product</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control"
                    value="{{ old('product_name', $product->product_name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        // Jika nama kolom di tabel categories adalah category_name
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="image_url">Product Image</label>
                <input type="file" name="image_url" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
