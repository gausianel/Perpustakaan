<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year' => 'required|integer',
        
        ]);
        
        $book = Book::create($validatedData);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($book, 200);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        
        $validatedData = $request->validate([
            'genre_id' => 'sometimes|exists:genres,id',
            'title' => 'sometimes|string',
            'author' => 'sometimes|string',
            'publisher' => 'sometimes|string',
            'year' => 'sometimes|integer',
            'purchase_date' => 'sometimes|date',
            'purchase_price' => 'sometimes|integer'
        ]);
        
        $book->update($validatedData);
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        
        $book->delete();
        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
}