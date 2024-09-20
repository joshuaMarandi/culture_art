@extends('layouts.guest_layout')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container">

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay">
            <h1>Discover Amazing Artworks and Cultural Products from all over the world</h1>
            <p>Browse through various art pieces created by talented artists.</p>
            
            <!-- Search Bar -->
            <div class="search-bar-container">
                <form action="{{ route('arts.index') }}" method="GET" class="search-bar-form">
                    <input type="text" name="search" placeholder="Search for art..." class="search-bar-input" aria-label="Search for art">
                    <button type="submit" class="search-bar-button">Search</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Products Grid Section -->
    <h2 class="text-center my-4">Browse Our Collection</h2>

    <!-- No products message -->
    @if($arts->isEmpty())
        <p class="no-products text-center">No artworks available at the moment. Please check back later.</p>
    @else
        <div class="products-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 my-4">
            @foreach($arts as $art)
            <a href="{{ route('buyer.view_product', $art->id) }}" class="block product-link hover:shadow-lg transition duration-300 ease-in-out">
                <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                    
                    <!-- Art Image -->
                    <div class="product-img h-48 w-full overflow-hidden">
                        @if($art->image)
                            <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-gray-500">
                                No Image  at this moment
                            </div>
                        @endif
                    </div>

                    <!-- Art Info -->
                    <div class="product-info p-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $art->title }}</h2>
                        <p class="text-gray-600">{{ Str::limit($art->description, 80) }}</p>
                        <p class="price text-indigo-500 font-bold mt-2">Tsh {{ number_format($art->price, 2) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Custom Pagination (Without Previous and Next Links) -->
        <div class="pagination-container my-4">
            {{ $arts->onEachSide(1)->links('vendor.pagination.simple-tailwind') }} <!-- Custom template -->
        </div>
    @endif

</div>
@endsection