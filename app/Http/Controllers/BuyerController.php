<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Art; // Import the Art model
use App\Models\User; // Import the User model

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Method for the buyer dashboard
    public function index()
    {
        // Logic for buyer dashboard (You can add more data if needed)
        return view('buyer.dashboard');
    }

    // Method for the buyer landing page
    public function landing()
    {
        // Fetch all artworks and pass to the landing view
        $arts = Art::all(); // Ensure Art model is properly defined
        return view('buyer.landing', compact('arts'));
    }
}
