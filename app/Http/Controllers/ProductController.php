<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Art; // Assuming you're using the `Art` model for products
use App\Models\User; // Seller model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showSellerPage($sellerId)
    {
        // Fetch seller details
        $seller = User::findOrFail($sellerId);

        // Fetch products associated with this seller
        $arts = Art::where('user_id', $sellerId)->get();

        // Pass the data to the view
        return view('seller.landing', compact('seller', 'arts'));
    }
    public function showBuyerLanding(Request $request)
    {
        // Fetch artworks from the database
        $arts = Art::all();

        return view('buyer.landing', compact('arts'));
    }

}
