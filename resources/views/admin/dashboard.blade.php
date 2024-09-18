@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Users -->
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Total Users</h2>
                <p class="text-gray-600">{{ $totalUsers ?? 0 }}</p>
            </div>
            <div class="bg-indigo-500 p-3 rounded-full">
                <i class="fas fa-users text-white"></i> <!-- Add a users icon -->
            </div>
        </div>

        <!-- Total Artworks -->
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Total Artworks</h2>
                <p class="text-gray-600">{{ $totalArtworks ?? 0 }}</p>
            </div>
            <div class="bg-green-500 p-3 rounded-full">
                <i class="fas fa-palette text-white"></i> <!-- Add an artwork icon -->
            </div>
        </div>

        <!-- Total Bids -->
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Total Bids</h2>
                <p class="text-gray-600">{{ $totalBids ?? 0 }}</p>
            </div>
            <div class="bg-red-500 p-3 rounded-full">
                <i class="fas fa-gavel text-white"></i> <!-- Add a bid icon -->
            </div>
        </div>

        <!-- Total Sales -->
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Total Sales</h2>
                <p class="text-gray-600">Tsh {{ number_format($totalSales ?? 0, 2) }}</p>
            </div>
            <div class="bg-yellow-500 p-3 rounded-full">
                <i class="fas fa-dollar-sign text-white"></i> <!-- Add a sales icon -->
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <h2 class="text-xl font-semibold mb-2">Recent Activities</h2>
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <ul class="space-y-2">
            @forelse($recentActivities as $activity)
                <li class="border-b pb-2">
                    <span class="text-gray-800">{{ $activity->description }}</span>
                    <span class="text-gray-600 text-sm float-right">{{ $activity->created_at->diffForHumans() }}</span>
                </li>
            @empty
                <li>No recent activities</li>
            @endforelse
        </ul>
    </div>

    <!-- Artwork Management -->
    <h2 class="text-xl font-semibold mb-2">Manage Artworks</h2>
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2">Title</th>
                    <th class="py-2">Artist</th>
                    <th class="py-2">Price</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artworks as $art)
                    <tr class="border-b">
                        <td class="py-2">{{ $art->title }}</td>
                        <td class="py-2">{{ $art->artist->name }}</td>
                        <td class="py-2">Tsh {{ number_format($art->price, 2) }}</td>
                        <td class="py-2">
                            <a href="{{ route('admin.edit_artwork', $art->id) }}" class="text-blue-500">Edit</a>
                            <a href="{{ route('admin.delete_artwork', $art->id) }}" class="text-red-500 ml-2">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- User Management -->
    <h2 class="text-xl font-semibold mb-2">Manage Users</h2>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2">Name</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Role</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b">
                        <td class="py-2">{{ $user->name }}</td>
                        <td class="py-2">{{ $user->email }}</td>
                        <td class="py-2">{{ ucfirst($user->role) }}</td>
                        <td class="py-2">
                            <a href="{{ route('admin.edit_user', $user->id) }}" class="text-blue-500">Edit</a>
                            <a href="{{ route('admin.delete_user', $user->id) }}" class="text-red-500 ml-2">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
