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
        $totalUsers = User::count();
        $totalArtworks = Art::count();
        $totalBids = Bid::count();
        
        // Calculate total sales from the Sale model
        $totalSales = Sale::sum('amount');

        $recentActivities = Activity::latest()->limit(5)->get(); 
        $artworks = Art::all();
        $users = User::all();

        return view('admin.dashboard', compact('totalUsers', 'totalArtworks', 'totalBids', 'totalSales', 'recentActivities', 'artworks', 'users'));
    }
}
