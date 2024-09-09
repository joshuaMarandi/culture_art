@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Seller's Dashboard</h1>

    <!-- Button to Create New Art -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('arts.create') }}" class="btn btn-primary">Add New Art</a>
    </div>

    <!-- Display Arts -->
    <div class="card">
        <div class="card-header">
            <h4>Your Arts</h4>
        </div>
        <div class="card-body">
            @if($arts->isEmpty())
                <p>You have not added any art yet.</p>
            @else
                <!-- Wrap table in responsive container -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($arts as $art)
                                <tr>
                                    <td>{{ $art->title }}</td>
                                    <td>Tsh {{ number_format($art->price, 2) }}</td>
                                    <td>
                                        @if($art->image)
                                            <img src="{{ asset('storage/' . $art->image) }}" alt="{{ $art->title }}" class="img-fluid" style="max-width: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('arts.show', $art->id) }}" class="btn btn-info btn-sm me-2">View</a>
                                        <a href="{{ route('arts.edit', $art->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
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
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
