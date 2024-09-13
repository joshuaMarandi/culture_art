<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Art;
use App\Models\Category;

class ArtController extends Controller
{
    // Display a listing of arts (publicly accessible)
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        
        // Fetch arts based on category_id if provided, otherwise fetch all
        $arts = $categoryId ? Art::where('category_id', $categoryId)->get() : Art::all();
        
        return view('arts.index', compact('arts'));
    }

    // Show the details of a specific art piece (publicly accessible)
    public function show($id)
    {
        $art = Art::findOrFail($id);
        return view('arts.show', compact('art'));
    }

    // Show the buyer landing page (publicly accessible)
    public function showBuyerLanding()
    {
        // Fetch all arts with their related category data
        $arts = Art::with('category')->get();
        
        return view('buyer.landing', compact('arts'));
    }

    // Seller dashboard (protected by 'seller' role)
    public function dashboard()
    {
        $arts = Art::where('user_id', auth()->id())->get();
        return view('seller.dashboard', compact('arts'));
    }

    // Display the form for creating new art
    public function create()
    {
        $categories = Category::all();
        return view('arts.create', compact('categories'));
    }

    // Store new art with image upload
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('arts', 'public'); // Store image in the public disk
        }

        $art = new Art($validatedData);
        $art->user_id = auth()->id();
        $art->image = $imagePath;
        $art->save();

        return redirect()->route('seller.dashboard')->with('success', 'Art created successfully');
    }

    // Display the form for editing the specified art
    public function edit($id)
    {
        $art = Art::findOrFail($id);
        $categories = Category::all();
        return view('arts.edit', compact('art', 'categories'));
    }

    // Update existing art with image upload
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $art = Art::findOrFail($id);

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('arts', 'public'); // Store new image
            $validatedData['image'] = $imagePath; // Save the new image path
        }

        $art->update($validatedData);

        return redirect()->route('seller.dashboard')->with('success', 'Art updated successfully');
    }

    // Delete the specified art
    public function destroy($id)
    {
        $art = Art::findOrFail($id);
        $art->delete();

        return redirect()->route('seller.dashboard')->with('success', 'Art deleted successfully');
    }
}
