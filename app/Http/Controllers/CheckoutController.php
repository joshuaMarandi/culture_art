<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Check if the cart is not empty
        if (\Cart::count() > 0) {
            // Fetch the cart items and total price from the cart
            $cartItems = \Cart::content(); // Retrieve all cart items
            $total = \Cart::total(); // Get the total price

            // Pass data to the checkout view
            return view('checkout.index', [
                'cartItems' => $cartItems,
                'total' => $total
            ]);
        } else {
            // If the cart is empty, redirect back with an error message
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
    }
}
