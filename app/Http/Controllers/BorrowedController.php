<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowed;
use Carbon\Carbon;
use App\Models\Book;

class BorrowedController extends Controller
{
    public function index()
    {
        $borroweds = Borrowed::with(['book', 'user', 'giveback'])->get();
        return response()->json($borroweds, 200);
    }

   

public function store(Request $request)
{
    $validatedData = $request->validate([
        'book_id' => 'required|exists:books,id',
        'user_id' => 'required|exists:users,id',
        // ...
    ]);

    $book = Book::find($validatedData['book_id']);

    if ($book->stock < 1) {
        return response()->json(['message' => 'Stock not available'], 400);
    }

    $validatedData['borrowed_date'] = Carbon::now();
    $validatedData['is_returned'] = false;

    // Kurangi stok
    $book->stock -= 1;
    $book->save();

    $borrowed = Borrowed::create($validatedData);

    return response()->json($borrowed, 201);
}


    public function show($id)
    {
        $borrowed = Borrowed::with(['book', 'user', 'giveback'])->find($id);

        if (!$borrowed) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($borrowed, 200);
    }

    public function update(Request $request, $id)
    {
        $borrowed = Borrowed::find($id);

        if (!$borrowed) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validatedData = $request->validate([
            'book_id' => 'sometimes|exists:books,id',
            'user_id' => 'sometimes|exists:users,id',
            'borrowed_date' => 'sometimes|date',
            'expected_return_date' => 'sometimes|date',
            'is_returned' => 'sometimes|boolean',
        ]);

        $borrowed->update($validatedData);

        return response()->json($borrowed, 200);
    }

    public function destroy($id)
    {
        $borrowed = Borrowed::find($id);

        if (!$borrowed) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $borrowed->delete();

        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
}
