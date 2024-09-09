@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">

    <!-- Hero Section -->
    <div class="relative bg-cover bg-center h-[60vh] rounded-lg mb-12" style="background-image: url('https://cdn.usegalileo.ai/sdxl10/f8f36888-768f-4a61-b911-d1257bf9283e.png');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center rounded-lg">
            <h1 class="text-4xl font-bold text-white text-center mb-4">Discover Amazing Artworks</h1>
            <p class="text-lg text-gray-300 text-center">Browse through various art pieces created by talented artists.</p>
        </div>
    </div>

    <!-- Slideshow Section -->
    <!-- <div class="mb-12">
        <h2 class="text-3xl font-bold text-center mb-6">Featured Artworks</h2>
        <div class="relative">
            <div class="slider overflow-hidden rounded-lg shadow-lg">
                @foreach($arts as $art)
                    @if($art->image)
                        <div class="slide">
                            <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div> -->

    <!-- Products Grid Section -->
    <h2 class="text-3xl font-bold text-center mb-6">Browse Our Collection</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
        @foreach($arts as $art)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Art Image -->
                <div class="aspect-w-1 aspect-h-1">
                    @if($art->image)
                        <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-500">
                            No Image Available
                        </div>
                    @endif
                </div>

                <!-- Art Info -->
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $art->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($art->description, 50) }}</p>
                    <p class="text-lg font-semibold text-blue-600 mb-4">Tsh {{ number_format($art->price, 2) }}</p>
                    <a href="{{ route('arts.show', $art->id) }}" class="block text-center text-white bg-blue-500 py-2 rounded hover:bg-blue-600">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- No products message -->
    @if($arts->isEmpty())
        <p class="text-center text-gray-600 mt-12">No artworks available at the moment. Please check back later.</p>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var slider = document.querySelector('.slider');
        var slides = slider.querySelectorAll('.slide');
        var currentIndex = 0;

        // Hide all slides initially
        function hideAllSlides() {
            slides.forEach((slide) => {
                slide.classList.remove('active');
            });
        }

        // Show slide by index
        function showSlide(index) {
            hideAllSlides();
            slides[index].classList.add('active');
        }

        // Show the next slide
        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        // Show the previous slide
        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        }

        // Initialize
        showSlide(currentIndex);
        setInterval(nextSlide, 5000); // Change slide every 5 seconds
    });
</script>
@endpush
