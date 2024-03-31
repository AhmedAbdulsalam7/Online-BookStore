<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function checkout(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shipping_address' => 'required|string',
        ]);

        // Retrieve the user's cart
        $cart = Cart::where('user_id', $validatedData['user_id'])->first();

        // Check if the cart exists
        if (!$cart) {
            return response()->json(['message' => 'Cart not found.'], 404);
        }

        // Retrieve the cart items
        $cartItems = $cart->items;

        // Create the order
        $order = new Order();
        $order->user_id = $validatedData['user_id'];
        $order->shipping_address = $validatedData['shipping_address'];
        $order->total_amount = 0; // Placeholder for total amount

        // Start a transaction
        \DB::beginTransaction();

        try {
            // Save the order
            $order->save();

            // Calculate total amount and update availability of books
            foreach ($cartItems as $cartItem) {
                $book = $cartItem->book;

                // Update book availability
                $book->quantity -= $cartItem->quantity;
                $book->save();

                // Update order total amount
                $order->total_amount += ($book->price * $cartItem->quantity);
            }

            // Save the updated order total amount
            $order->save();

            // Delete the cart and cart items
            $cart->delete();

            \DB::commit();

            return response()->json(['message' => 'Order placed successfully.'], 201);
        } catch (\Exception $e) {
            \DB::rollback();

            return response()->json(['message' => 'Failed to place order.'], 500);
        }
    }

    public function getUserOrders()
    {
        // Retrieve all orders for the specified user
        $userId = auth()->user()->id;
        $orders = Order::where('user_id', $userId)->get();

        return response()->json($orders, 200);
    }
}
