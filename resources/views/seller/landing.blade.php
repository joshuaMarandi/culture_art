@extends('layouts.app') 
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container mx-auto px-6 py-12">
    <!-- Seller Details Section -->
    <div class="flex flex-col items-center mb-12">
        @if(isset($seller))
            <h1 class="text-4xl font-extrabold text-center mb-4 text-indigo-700">Welcome to {{ $seller->name }}'s Store</h1>
            <p class="text-lg text-gray-600">Browse the best artwork available from {{ $seller->name }}.</p>
        @else
            <h1 class="text-4xl font-extrabold text-center mb-4 text-indigo-700">Welcome to Our Art Store</h1>
            <p class="text-lg text-gray-600">Browse the best artwork available from talented artists.</p>
        @endif
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <form action="{{ route('buyer.page') }}" method="GET" class="flex items-center">
            <input type="text" name="query" placeholder="Search artworks..." class="border border-gray-300 rounded py-2 px-4 w-full md:w-1/2 lg:w-1/3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button type="submit" class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition duration-300">Search</button>
        </form>
    </div>

    <!-- Products Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($arts as $art)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
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
                    <h2 class="text-xl font-bold mb-2 text-indigo-600">{{ $art->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($art->description, 50) }}</p>
                    <p class="text-lg font-semibold text-indigo-700 mb-4">Tsh {{ number_format($art->price, 2) }}</p>
                    <a href="{{ route('arts.show', $art->id) }}" class="block text-center text-white bg-indigo-600 py-2 rounded hover:bg-indigo-700 transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600 mt-12">No artworks added yet.</p>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $arts->links() }}
    </div>
</div>
@endsection
