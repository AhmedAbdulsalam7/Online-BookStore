<?php

namespace App\Http\Controllers;
use App\Models\CartItem;

use Illuminate\Http\Request;

class CartItemController extends Controller
{

    public function index()
    {
        // Retrieve all cart items
        $cartItems = CartItem::all();
        return response()->json($cartItems, 200);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new cart item
        $cartItem = CartItem::create($validatedData);

        return response()->json($cartItem, 201);
    }

    public function show($id)
    {
        // Find the cart item by ID
        $cartItem = CartItem::findOrFail($id);
        return response()->json($cartItem, 200);
    }

    public function destroy($id)
    {
        // Find the cart item by ID and delete it
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        
        return response()->json(['message' => 'Cart item deleted successfully.'], 200);
    }
}
