<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Art; // Make sure to include the Art model
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Add item to cart
    public function add($id)
    {
        // Fetch the product using the ID
        $product = Art::findOrFail($id);

        // Check if the cart already exists in the session
        $cart = session()->get('cart', []);

        // If the item exists in the cart, increment the quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Add the item to the cart
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // View the cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Remove item from cart
    
public function remove($id)
{
    // Get the current cart from the session
    $cart = session()->get('cart');

    // If the cart exists and the item is in it, remove it
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    return redirect()->back()->with('error', 'Product not found in cart.');
}
    // Clear cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
    
}
