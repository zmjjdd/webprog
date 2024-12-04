@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image_url }}" class="img-fluid" alt="{{ $product->product_name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->product_name }}</h2>
            <p>{{ $product->description }}</p>
            <p><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
        </div>
    </div>
@endsection
