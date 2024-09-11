<!-- resources/views/buyer/view_product.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <h3>Description</h3>
            <p>{{ $product->description }}</p>
            <h3>Price: Tsh {{ number_format($product->price, 2) }}</h3>
            
            <!-- Add to Cart Button -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>

    <!-- Product Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Customer Reviews</h3>
            <!-- Display reviews if any -->
            @if($product->reviews && $product->reviews->isNotEmpty())
                <ul class="list-unstyled">
                    @foreach($product->reviews as $review)
                        <li class="media mb-4">
                            <img src="{{ asset('storage/' . $review->user->profile_image) }}" class="mr-3" alt="{{ $review->user->name }}" style="width: 64px; height: 64px; border-radius: 50%;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">{{ $review->user->name }} - {{ $review->created_at->format('M d, Y') }}</h5>
                                <p>{{ $review->comment }}</p>
                                <small>Rating: {{ $review->rating }} / 5</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No reviews yet. Be the first to review this product!</p>
            @endif
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Related Products</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                <p class="card-text">Price: Tsh {{ number_format($relatedProduct->price, 2) }}</p>
                                <a href="{{ route('product.show', $relatedProduct->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
