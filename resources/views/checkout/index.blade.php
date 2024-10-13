@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    
    
    @if(!empty($cartItems) && count($cartItems) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'], 2) }}</td>
                    <td>{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: Tsh {{ number_format($total, 2) }}</h4>
        
        <button class="btn btn-primary">Proceed to Payment</button>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
