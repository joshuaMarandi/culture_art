<?php

// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Art;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $product = Art::findOrFail($productId);

        $review = new Review();
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->user_id = auth()->id(); // Associate the review with the logged-in user
        $review->product_id = $product->id; // Associate the review with the product
        $review->save();

        return redirect()->back()->with('success', 'Your review has been submitted successfully!');
    }
}
