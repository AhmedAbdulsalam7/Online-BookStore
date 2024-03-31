<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Validator;
class BookController extends Controller
{
    public function index() {
        $book = Book::all();
        return response()->json([
            'success' => true,
            'message' => 'All Books',
            'books' => $book
        ], 200);
    }

    public function store(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request',
                'error' => $validator->errors()
            ], 400);
        }

        $book = Book::Create($input);
        return response()->json([
            'success' => true,
            'message' => 'Book Created Succesfully',
            'book' => $book
        ], 200);
    }


    public function show($id) {
        $book = Book::find($id);
        if(is_null($book)) {
            return response()->json([
                'success' => false,
                'message' => 'Not Found.',
            ], 400);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Book Retrieve Successfully.',
            'data' => $book
        ], 200);
    }


    public function update(Request $request, Book $book) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request',
                'error' => $validator->errors()
            ], 400);
        }

        $book->title = $input['title'];
        $book->author = $input['author'];
        $book->category = $input['category'];
        $book->price = $input['price'];
        $book->availability = $input['availability'];
        $book->quantity = $input['quantity'];
        $book->save();

        return response()->json([
            'success' => true,
            'message' => 'Book Updated Succesfully',
            'book' => $book
        ], 200);
    }


    public function destroy(Book $book) {

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book Deleted Succesfully',
            'book' => $book
        ], 200);
    }
}
