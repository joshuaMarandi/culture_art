<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Art;

class ArtController extends Controller
{
    // Display a listing of arts (publicly accessible)
    public function index()
    {
        $arts = Art::all(); // Fetch all art records
        return view('arts.index', compact('arts'));
    }

    // Show the details of a specific art piece (publicly accessible)
    public function show($id)
    {
        $art = Art::findOrFail($id); // Find the art by ID or fail
        return view('arts.show', compact('art')); // Pass the art data to the view
    }

    // Show the buyer landing page (publicly accessible)
    public function showBuyerLanding()
    {
        $arts = Art::all(); // Fetch all arts for the landing page
        return view('buyer.landing', compact('arts'));
    }

    // Seller dashboard (protected by 'seller' role)
    public function dashboard()
    {
        $arts = Art::where('user_id', auth()->id())->get(); // Fetch only arts from the logged-in seller
        return view('seller.dashboard', compact('arts'));
    }

    // Other methods for sellers to create, update, and delete art
    public function create()
    {
        return view('arts.create');
    }

    // Store new art with image upload
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure valid image
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('arts_images', 'public'); // Store image in the public disk
        }

        $art = new Art($validatedData);
        $art->user_id = auth()->id(); // Assign the current seller to the art piece
        $art->image = $imagePath; // Save the image path in the database
        $art->save();

        return redirect()->route('seller.dashboard')->with('success', 'Art created successfully');
    }

    public function edit($id)
    {
        $art = Art::findOrFail($id);
        return view('arts.edit', compact('art'));
    }

    // Update existing art with image upload
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Image is optional during update
        ]);

        $art = Art::findOrFail($id);

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('arts_images', 'public'); // Store new image
            $validatedData['image'] = $imagePath; // Save the new image path
        }

        $art->update($validatedData);

        return redirect()->route('seller.dashboard')->with('success', 'Art updated successfully');
    }

    public function destroy($id)
    {
        $art = Art::findOrFail($id);
        $art->delete();

        return redirect()->route('seller.dashboard')->with('success', 'Art deleted successfully');
    }
}
