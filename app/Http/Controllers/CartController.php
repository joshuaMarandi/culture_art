<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Art; // Assuming you're using the Art model
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Art::findOrFail($id);

        // Add the product to the cart
        // For example, you can use session or a database to manage the cart
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
    // app/Http/Controllers/CartController.php

public function viewCart()
{
    $cart = session()->get('cart', []);

    return view('cart.index', compact('cart'));
}

}

