<?php

// app/Http/Controllers/ArtController.php

namespace App\Http\Controllers;

use App\Models\Art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Add this line


class ArtController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:seller']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('arts', 'public');

        Art::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'user_id' => Auth::id(), // Make sure the user ID is being assigned
        ]);

        return redirect()->route('arts.index')->with('success', 'Art created successfully.');
    }

    public function show(Art $art)
    {
        $this->authorize('view', $art);
        return view('arts.show', compact('art'));
    }

    public function edit(Art $art)
    {
        $this->authorize('update', $art);
        return view('arts.edit', compact('art'));
    }

    public function update(Request $request, Art $art)
    {
        $this->authorize('update', $art);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($art->image);
            $imagePath = $request->file('image')->store('arts', 'public');
            $art->image = $imagePath;
        }

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
        $this->authorize('delete', $art);

        Storage::disk('public')->delete($art->image);
        $art->delete();
        return redirect()->route('arts.index')->with('success', 'Art deleted successfully.');
    }

    // Add this method to handle dashboard view
    // public function dashboard()
    // {
    //     $arts = Auth::user()->arts; // Fetch the arts for the logged-in seller
    //     return view('seller.dashboard', compact('arts'));
    // }
    public function dashboard()
{
    $arts = Auth::user()->arts; // Fetch the arts for the logged-in seller
    return view('seller.dashboard', compact('arts'));
}

}
