<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;


Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    //USER
    Route::get('user-info', [PassportAuthController::class, 'userInfo']);

    //Book
    Route::resource('books', BookController::class);

    //CART
    Route::post('cart/add-to-cart', [CartController::class, 'addToCart']);

    // CARTITEM
    Route::get('cart-items', [CartItemController::class, 'index']);
    Route::post('cart-items', [CartItemController::class, 'store']);
    Route::get('cart-items/{id}', [CartItemController::class, 'show']);
    Route::delete('cart-items/{id}', [CartItemController::class, 'destroy']);

    //ORDER
    Route::post('checkout', [OrderController::class, 'checkout']);
    Route::get('orders', [OrderController::class, 'getUserOrders']);
});
