@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $art->title }}</h1>

    <div class="card mb-4">
        <img src="{{ asset('storage/' . $art->image) }}" class="card-img-top" alt="{{ $art->title }}">
        <div class="card-body">
            <h5 class="card-title">{{ $art->title }}</h5>
            <p class="card-text">{{ $art->description }}</p>
            <p class="card-text"><strong>${{ $art->price }}</strong></p>
            <a href="{{ route('arts.index') }}" class="btn btn-secondary">Back to Listings</a>
            <a href="{{ route('arts.edit', $art->id) }}" class="btn btn-primary">Edit Art</a>
            <form action="{{ route('arts.destroy', $art->id) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Art</button>
            </form>
        </div>
    </div>
</div>
@endsection
