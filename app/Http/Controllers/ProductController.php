<?php

namespace App\Http\Controllers;

use App\Models\Art; // Assuming you're using the `Art` model for products
use App\Models\User; // Seller model
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the seller's page with their listed arts.
     *
     * @param int $sellerId
     * @return \Illuminate\View\View
     */
    public function showSellerPage($sellerId)
    {
        // Fetch seller details
        $seller = User::findOrFail($sellerId);

        // Fetch products (arts) associated with this seller with pagination
        $arts = Art::where('user_id', $sellerId)->paginate(10);

        // Pass the data to the view
        return view('seller.landing', compact('seller', 'arts'));
    }

    /**
     * Show the buyer's landing page with all available arts.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function showBuyerLanding(Request $request)
    {
        // Fetch artworks from the database with pagination
        $arts = Art::paginate(12);

        // Pass the data to the view
        return view('buyer.landing', compact('arts'));
    }

    /**
     * Show a specific product (art) details.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Fetch the art (product) details and related reviews using eager loading
        $product = Art::with('reviews.user', 'category')->findOrFail($id);

        // Fetch related products based on the category
        $relatedProducts = $product->category_id 
            ? Art::where('category_id', $product->category_id)
                  ->where('id', '!=', $id)
                  ->take(4) // Limit related products
                  ->get()
            : collect(); // If no category_id, return an empty collection

        // Pass the data to the view
        return view('buyer.view_product', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form to create a new art product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Fetch all categories to populate the dropdown
        $categories = Category::all();

        return view('art.create', compact('categories'));
    }

    /**
     * Store a new art product in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'category_id' => 'required|exists:categories,id', // Validate category selection
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('arts', 'public');

        // Create a new art product
        Art::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id, // Save the selected category
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('art.index')->with('success', 'Art product created successfully!');
    }
}
