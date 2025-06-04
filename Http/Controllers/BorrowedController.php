<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowed;

class BorrowedController extends Controller
{
    public function index()
    {
        return response()->json(Borrowed::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'giveback_id' => 'required|exists:givebacks,id',
            'borrowed_date' => 'required|date'
        ]);
        
        $borrowed = Borrowed::create($validatedData);
        return response()->json($borrowed, 201);
    }

    public function show($id)
    {
        $borrowed = Borrowed::find($id);
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
            'giveback_id' => 'required|exists:givebacks,id',
            'borrowed_date' => 'sometimes|date'
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
