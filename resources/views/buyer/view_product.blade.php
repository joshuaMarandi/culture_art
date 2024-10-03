<!-- resources/views/buyer/view_product.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="border rounded shadow-sm p-3 bg-white">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded w-100">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6 col-md-12">
            <div class="border rounded shadow-sm p-4 bg-white">
                <h1 class="display-4">{{ $product->name }}</h1>
                <h4 class="text-muted mb-4">Tsh {{ number_format($product->price, 2) }}</h4>

                <h5>Description</h5>
                <p class="lead mb-4">{{ $product->description }}</p>

                <!-- Add to Cart Button -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Add to Cart</button>
                </form>
            </div>
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
                <li class="media mb-4 p-3 bg-light rounded shadow-sm">
                    <img src="{{ asset('storage/' . $review->user->profile_image) }}" class="mr-3" alt="{{ $review->user->name }}" style="width: 64px; height: 64px; border-radius: 50%;">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1">{{ $review->user->name }} - {{ $review->created_at->format('M d, Y') }}</h5>
                        <p>{{ $review->comment }}</p>
                        <small class="text-muted">Rating: {{ $review->rating }} / 5</small>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-muted">No reviews yet. Be the first to review this product!</p>
            @endif

            <!-- Add Review Form -->
            @auth
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Add Your Review</h5>
                    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="rating">Rating (out of 5):</label>
                            <select name="rating" id="rating" class="form-control" required>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Review</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Related Products</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top rounded" alt="{{ $relatedProduct->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p class="card-text text-muted">Price: Tsh {{ number_format($relatedProduct->price, 2) }}</p>
                            <a href="{{ route('product.show', $relatedProduct->id) }}" class="btn btn-outline-primary btn-block">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
