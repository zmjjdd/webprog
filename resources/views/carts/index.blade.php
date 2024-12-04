@extends('layouts.app')

@section('content')
    <h2>Your Cart</h2>

    @if ($cart->products->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>Rp {{ number_format($product->pivot->price, 0, ',', '.') }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>Rp {{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-right">
            <h4>Total: Rp {{ number_format($cart->totalPrice(), 0, ',', '.') }}</h4>
            <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
        </div>
    @endif
@endsection
