<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add a book to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the user and book
        $user = auth()->user();
        $book = Book::findOrFail($validatedData['book_id']);

        // Check if the book is available
        if ($book->quantity < $validatedData['quantity']) {
            return response()->json(['message' => 'Book not available in sufficient quantity.'], 400);
        }

        // Find or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $validatedData['user_id']]);

        // Add the book to the cart
        $cartItem = $cart->items()->updateOrCreate(
            ['book_id' => $validatedData['book_id']],
            ['quantity' => $validatedData['quantity']]
        );

        // Decrease the book quantity
        // $book->decrement('quantity', $validatedData['quantity']);

        return response()->json(['message' => 'Book added to cart successfully.'], 200);
    }
}
