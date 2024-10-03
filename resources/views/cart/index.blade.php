@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    
    
    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Tsh {{ number_format($item['price'], 2) }}</td>
                        <td>Tsh {{ number_format($item['quantity'] * $item['price'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-warning">Clear Cart</button>
        </form>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
    @else
        <p>Your cart is empty. Don't you believe</p>
    @endif
</div>
@endsection
