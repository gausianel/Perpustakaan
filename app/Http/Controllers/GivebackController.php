<?php

namespace App\Http\Controllers;

use App\Models\Giveback;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowed;


class GivebackController extends Controller
{
    public function index()
    {
        return Giveback::with('borrowed')->get();
    }

 
public function store(Request $request)
{
    $validatedData = $request->validate([
        'borrowed_id' => 'required|exists:borroweds,id',
        'date_returned' => 'required|date',
    ]);

    $borrowed = Borrowed::find($validatedData['borrowed_id']);
    if (!$borrowed) {
        return response()->json(['message' => 'Borrowed record not found'], 404);
    }

    if ($borrowed->is_returned) {
        return response()->json(['message' => 'Book already returned'], 400);
    }

    $book = Book::find($borrowed->book_id);

    // Tambah stok buku
    $book->stock += 1;
    $book->save();

    // Tandai peminjaman sudah dikembalikan
    $borrowed->is_returned = true;
    $borrowed->save();

    $giveback = Giveback::create($validatedData);

    return response()->json($giveback, 201);
}

    public function show($id)
    {
        $giveback = Giveback::with('borrowed')->findOrFail($id);
        return response()->json($giveback);
    }

    public function update(Request $request, $id)
    {
        $giveback = Giveback::findOrFail($id);

        $request->validate([
            'borrowed_id' => 'required|exists:borroweds,id',
            'date_returned' => 'required|date',
        ]);

        $giveback->update($request->only(['borrowed_id', 'date_returned']));

        return response()->json([
            'message' => 'Giveback updated successfully.',
            'data' => $giveback
        ]);
    }

    public function destroy($id)
    {
        $giveback = Giveback::findOrFail($id);
        $giveback->delete();

        return response()->json(['message' => 'Giveback deleted successfully.']);
    }
}
