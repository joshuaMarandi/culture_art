@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <h2>Your Cart</h2>

            @foreach($cartItems as $item)
                <div class="cart-item mb-3">
                    <h5>{{ $item->name }}</h5>
                    <p>Quantity: {{ $item->qty }}</p>
                    <p>Price: Tsh {{ number_format($item->price, 2) }}</p>
                </div>
            @endforeach
        </div>
        
        <div class="col-md-4">
            <h2>Order Summary</h2>
            <p>Total: Tsh {{ number_format($total, 2) }}</p>

            <a href="{{ route('checkout.process') }}" class="btn btn-primary">Proceed to Payment</a>
        </div>
    </div>
</div>
@endsection
