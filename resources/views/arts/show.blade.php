<!-- resources/views/arts/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $art->title }}</h1>
    <p>{{ $art->description }}</p>
    <p>Price: ${{ $art->price }}</p>

    <!-- Display the image -->
    @if($arts->image)
        <img src="{{ Storage::url($arts->image) }}" alt="{{ $art->title }}" class="img-fluid">
    @else
        <p>No image available.</p>
    @endif
</div>
@endsection
