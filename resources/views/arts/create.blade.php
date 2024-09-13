@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Art</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('arts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Description Field -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <!-- Price Field -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <!-- Category Dropdown -->
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="" disabled selected>Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Image Upload -->
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Art</button>
    </form>
</div>
@endsection
