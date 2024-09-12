<?php

// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Art;
use App\Models\User;

class ReviewController extends Controller
{
    public function store(Request $request, $artId)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Find the art (product) by ID or throw a 404 error
        $art = Art::findOrFail($artId);

        // Create a new review
        $review = new Review();
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->user_id = auth()->id(); // Associate the review with the logged-in user
        $review->art_id = $art->id; // Associate the review with the art (product)
        $review->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your review has been submitted successfully!');
    }
}
