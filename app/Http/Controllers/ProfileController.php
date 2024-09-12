<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Return the profile view with user data
        return view('profile.show', compact('user'));
    }
    // app/Http/Controllers/ProfileController.php

public function edit()
{
    $user = auth()->user();
    return view('profile.edit', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        // Add more validation rules as needed
    ]);

    $user->update($request->only('name', 'email'));

    return redirect()->route('profile')->with('status', 'Profile updated!');
}

}

