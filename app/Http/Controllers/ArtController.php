<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Art;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ArtController extends Controller
{
    // Display the buyer landing page with a list of arts (publicly accessible)
    public function showBuyerLanding()
    {
        // Fetch arts with related category data and paginate results (20 records per page)
        $arts = Art::with('category')->paginate(20);
        
        // Optionally pass the seller details if needed (for authenticated users)
        $seller = auth()->check() ? auth()->user() : null;

        return view('buyer.landing', compact('arts', 'seller'));
    }

    // Show the details of a specific art piece (publicly accessible)
    public function show($id)
    {
        // Eager load category with the art
        $art = Art::with('category')->findOrFail($id);
        return view('arts.show', compact('art'));
    }

    // Seller dashboard showing their own uploaded arts (protected by 'seller' role)
    public function dashboard()
    {
        // Fetch arts for the authenticated seller, eager load categories
        $arts = Art::where('user_id', auth()->id())->with('category')->get();
        return view('seller.dashboard', compact('arts'));
    }

    // Display the form for creating a new art (accessible by seller)
    public function create()
    {
        // Fetch all categories to display in the form
        $categories = Category::all();
        return view('arts.create', compact('categories'));
    }

    // Store a new art piece, including image upload (accessible by seller)
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('arts', 'public');

        // Create and save the new art
        $art = new Art($validatedData);
        $art->user_id = auth()->id(); // Assign the authenticated user as the owner
        $art->image = $imagePath; // Store the image path
        $art->save();

        return redirect()->route('seller.dashboard')->with('success', 'Art created successfully');
    }

    // Display the form for editing an existing art piece (accessible by seller)
    public function edit($id)
    {
        $art = Art::findOrFail($id);
        $categories = Category::all(); // Fetch categories for dropdown
        return view('arts.edit', compact('art', 'categories'));
    }

    // Update an existing art piece, including image upload (accessible by seller)
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $art = Art::findOrFail($id);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($art->image) {
                Storage::disk('public')->delete($art->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('arts', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update the art piece with the validated data
        $art->update($validatedData);

        return redirect()->route('seller.dashboard')->with('success', 'Art updated successfully');
    }

    // Delete an art piece and its associated image (accessible by seller)
    public function destroy($id)
    {
        $art = Art::findOrFail($id);

        // Delete the associated image from storage
        if ($art->image) {
            Storage::disk('public')->delete($art->image);
        }

        // Delete the art record from the database
        $art->delete();

        return redirect()->route('seller.dashboard')->with('success', 'Art deleted successfully');
    }
    public function index(Request $request)
{
    $categoryId = $request->input('category_id');
    $searchQuery = $request->input('search');

    // Fetch arts based on category_id and search query
    $artsQuery = Art::with('category');

    if ($categoryId) {
        $artsQuery->where('category_id', $categoryId);
    }

    if ($searchQuery) {
        $artsQuery->where('title', 'like', '%' . $searchQuery . '%')
                   ->orWhere('description', 'like', '%' . $searchQuery . '%');
    }

    $arts = $artsQuery->paginate(20);

    return view('arts.index', compact('arts'));
}

}
