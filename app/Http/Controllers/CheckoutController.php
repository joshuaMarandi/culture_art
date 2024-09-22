<?php

// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get cart items from the session
        $cart = session()->get('cart', []);

        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('buyer.landing')->with('error', 'Your cart is empty!');
        }

        // Return the checkout view with cart data
        return view('checkout.index', compact('cart'));
    }
}

