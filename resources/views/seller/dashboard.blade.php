@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seller Dashboard</h1>

    <!-- Button to Create New Art -->
    <a href="{{ route('arts.create') }}" class="btn btn-primary mb-3">Add New Art</a>

    <!-- Display Arts -->
    <div class="card">
        <div class="card-header">
            <h4>Your Arts</h4>
        </div>
        <div class="card-body">
            @if($arts->isEmpty())
                <p>You have not added any art yet.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arts as $art)
                            <tr>
                                <td>{{ $art->title }}</td>
                                <td>{{ Str::limit($art->description, 50) }}</td>
                                <td>${{ number_format($art->price, 2) }}</td>
                                <td>
                                    @if($art->image)
                                        <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}" style="width: 100px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('arts.show', $art->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('arts.edit', $art->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('arts.destroy', $art->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this art?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
