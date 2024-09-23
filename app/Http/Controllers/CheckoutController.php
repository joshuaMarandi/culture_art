<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Retrieve cart items from the session (default to an empty array if not set)
        $cartItems = session()->get('cart', []);
        
        // Calculate the total price
        $total = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Pass the cart data and total to the view
        return view('checkout.index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        if (isset($cart[$request->id])) {
            // Update quantity if the product exists
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            // Add new product to cart
            $cart[$request->id] = [
                "name" => $request->name,
                "price" => $request->price,
                "quantity" => $request->quantity,
            ];
        }

        // Store the updated cart back to the session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        // Remove item from cart if it exists
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
