@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <!-- Seller Details Section -->
    <div class="flex flex-col items-center mb-12">
        <h1 class="text-4xl font-bold text-center mb-4">Welcome to {{ $seller->name }}'s Store</h1>
        <p class="text-lg text-gray-600">Browse the best artwork available from {{ $seller->name }}.</p>
    </div>

    <!-- Products Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($arts as $art)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Art Image -->
                <div class="aspect-w-1 aspect-h-1">
                    @if($art->image)
                        <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-500">
                            No Image
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
        <p class="text-center text-gray-600 mt-12">No artworks added yet.</p>
    @endif
</div>
@endsection
