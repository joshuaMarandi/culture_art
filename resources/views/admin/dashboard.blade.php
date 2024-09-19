@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    <!-- Summary Section -->
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <p>{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Artworks</h5>
                    <p>{{ $totalArtworks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Total Sales</h5>
                    <p>Tsh {{ number_format($totalSales, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <h2 class="my-4">Recent Activities</h2>
    @if($recentActivities->isNotEmpty())
        <ul class="list-group">
            @foreach($recentActivities as $activity)
                <li class="list-group-item">
                    {{ $activity->description }} - {{ $activity->created_at->format('d M Y H:i') }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No recent activities.</p>
    @endif

    <!-- Artworks Section -->
    <h2 class="my-4">All Artworks</h2>
    @if($artworks->isNotEmpty())
        <div class="row">
            @foreach($artworks as $artwork)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($artwork->image)
                            <img src="{{ asset('storage/' . $artwork->image) }}" class="card-img-top" alt="{{ $artwork->title }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $artwork->title ?? 'No Title' }}</h5>
                            <p class="card-text">{{ Str::limit($artwork->description ?? 'No Description Available', 100) }}</p>
                            <p class="card-text"><strong>Tsh {{ number_format($artwork->price ?? 0, 2) }}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No artworks available.</p>
    @endif

    <!-- Users Section -->
    <h2 class="my-4">All Users</h2>
    @if($users->isNotEmpty())
        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item">
                    {{ $user->name }} - {{ $user->email }} - {{ $user->role }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No users found.</p>
    @endif
</div>
@endsection
