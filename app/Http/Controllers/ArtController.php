<?php

namespace App\Http\Controllers;

use App\Models\Art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtController extends Controller
{
    public function __construct()
    {
        // Apply authentication middleware to protect these routes
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        // Display all arts. You might want to add filtering or pagination later.
        $arts = Art::all();
        return view('arts.index', compact('arts'));
    }

    public function create()
    {
        return view('arts.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the image and get its path
        $imagePath = $request->file('image')->store('arts', 'public');

        // Create a new art entry with the logged-in user's ID
        Art::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'user_id' => Auth::id(),  // Assign the logged-in user's ID
        ]);

        return redirect()->route('arts.index')->with('success', 'Art created successfully.');
    }

    public function show(Art $art)
    {
        return view('arts.show', compact('art'));
    }

    public function edit(Art $art)
    {
        // Ensure the user has permission to edit the art
        $this->authorize('update', $art);

        return view('arts.edit', compact('art'));
    }

    public function update(Request $request, Art $art)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image from storage
            Storage::disk('public')->delete($art->image);

            // Store the new image and update the path
            $imagePath = $request->file('image')->store('arts', 'public');
            $art->image = $imagePath;
        }

        // Update the art entry with new data
        $art->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $art->image,
        ]);

        return redirect()->route('arts.index')->with('success', 'Art updated successfully.');
    }

    public function destroy(Art $art)
    {
        // Ensure the user has permission to delete the art
        $this->authorize('delete', $art);

        // Delete the image from storage
        Storage::disk('public')->delete($art->image);

        // Delete the art entry from the database
        $art->delete();

        return redirect()->route('arts.index')->with('success', 'Art deleted successfully.');
    }
}
