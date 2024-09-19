<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Art;
use App\Models\Sale;
use App\Models\Activity;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalArtworks = Art::count();
        $totalSales = Sale::sum('amount'); // Assuming 'amount' is the correct column

        // Fetch recent activities
        $recentActivities = Activity::latest()->limit(5)->get();

        // Fetch all artworks and users
        $artworks = Art::all();
        $users = User::all();

        return view('admin.dashboard', compact('totalUsers', 'totalArtworks', 'totalSales', 'recentActivities', 'artworks', 'users'));
    }
}
