@extends('layouts.app')

@section('content')
    <h2>Checkout</h2>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->products as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>Rp {{ number_format($product->pivot->price, 0, ',', '.') }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>Rp {{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-right">
        <h4>Total: Rp {{ number_format($cart->totalPrice(), 0, ',', '.') }}</h4>
        <button id="pay-button" class="btn btn-primary">Pay Now</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="your-midtrans-client-key"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert('Payment success');
                    window.location.href = '{{ route('cart.index') }}';
                },
                onPending: function(result) {
                    alert('Payment pending');
                },
                onError: function(result) {
                    alert('Payment failed');
                },
                onClose: function() {
                    alert('Payment popup closed without completing the process');
                }
            });
        });
    </script>
@endsection
