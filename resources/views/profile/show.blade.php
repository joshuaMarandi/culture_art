<!-- resources/views/profile/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}'s Profile</h1>
    <p>Email: {{ $user->email }}</p>
    <!-- Add more user details here -->

    <!-- Add a link to edit the profile if needed -->
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection



