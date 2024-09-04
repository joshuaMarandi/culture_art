@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Art Listings</h1>
    <a href="{{ route('arts.create') }}" class="btn btn-primary">Add New Art</a>
    <div class="row mt-4">
        @foreach($arts as $art)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $art->image) }}" class="card-img-top" alt="{{ $art->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $art->title }}</h5>
                        <p class="card-text">{{ $art->description }}</p>
                        <p class="card-text"><strong>${{ $art->price }}</strong></p>
                        <a href="{{ route('arts.show', $art) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('arts.edit', $art) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('arts.destroy', $art) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
