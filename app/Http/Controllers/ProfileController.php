<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Return the profile view with user data
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Add more validation rules if needed
        ]);

        // Update the user data
        // $user->update($request->only('name', 'email'));

        // Redirect with a success message
        return redirect()->route('profile.show')->with('status', 'Profile updated!');
    }
}
