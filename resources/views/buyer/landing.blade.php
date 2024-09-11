@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container">

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay">
            <h1>Discover Amazing Artworks</h1>
            <p>Browse through various art pieces created by talented artists.</p>
        </div>
    </div>

    <!-- Products Grid Section -->
    <h2 class="text-center">Browse Our Collection</h2>

    <div class="products-grid">
        @foreach($arts as $art)
            <div class="product-card">
                <!-- Art Image -->
                <div class="product-image">
                    @if($art->image)
                        <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}">
                    @else
                        <div class="text-gray-500">
                            No Image Available
                        </div>
                    @endif
                </div>

                <!-- Art Info -->
                <div class="product-info">
                    <h2>{{ $art->title }}</h2>
                    <p>{{ Str::limit($art->description, 50) }}</p>
                    <p class="price">Tsh {{ number_format($art->price, 2) }}</p>
                    <a href="{{ route('arts.show', $art->id) }}">View Details</a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- No products message -->
    @if($arts->isEmpty())
        <p class="no-products">No artworks available at the moment. Please check back later.</p>
    @endif

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var slider = document.querySelector('.slider');
        var slides = slider.querySelectorAll('.slide');
        var currentIndex = 0;

        function hideAllSlides() {
            slides.forEach((slide) => {
                slide.classList.remove('active');
            });
        }

        function showSlide(index) {
            hideAllSlides();
            slides[index].classList.add('active');
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        }

        showSlide(currentIndex);
        setInterval(nextSlide, 5000); // Change slide every 5 seconds
    });
</script>
@endpush
