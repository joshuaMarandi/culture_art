<!-- resources/views/arts/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $art->title }}</h1>
    <p>{{ $art->description }}</p>
    <p>Price: Tsh {{ $art->price }}</p>

    <!-- Display the image -->
    @if($art->image)
    <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}" class="img-fluid">
    @else
        <p>No image available Try again later.</p>
    @endif
</div>
@endsection
