<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Art;
use App\Models\Bid;
use App\Models\Activity;
use App\Models\Sale; // Import Sale model

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Count total users, artworks, and bids
        $totalUsers = User::count();
        $totalArtworks = Art::count();
        $totalBids = Bid::count();
        
        // Calculate total sales from the Sale model
        $totalSales = Sale::sum('amount'); // Adjust the 'amount' field based on your schema

        // Fetch the most recent activities (if available)
        $recentActivities = Activity::latest()->limit(5)->get(); 
        
        // Fetch all artworks and users
        $arts = Art::all();
        $users = User::all();

        // Pass data to the view
        return view('admin.dashboard', compact('totalUsers', 'totalArtworks', 'totalBids', 'totalSales', 'recentActivities', 'arts', 'users'));
    }
}
