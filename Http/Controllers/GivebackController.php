<?php

namespace App\Http\Controllers;

use App\Models\Giveback;
use App\Models\Borrowed;
use App\Models\Librarian;
use Illuminate\Http\Request;

class GivebackController extends Controller
{
    public function index()
    {
        $givebacks = Giveback::with(['borrowed', 'librarian'])->get();
        return view('givebacks.index', compact('givebacks'));
    }

    public function create()
    {
        $borroweds = Borrowed::all();
        $librarians = Librarian::all();
        return view('givebacks.create', compact('borroweds', 'librarians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'borrowed_id' => 'required|exists:borroweds,id',
            'librarian_id' => 'required|exists:librarians,id',
            'date_returned' => 'required|date',
        ]);

        Giveback::create([
            'borrowed_id' => $request->borrowed_id,
            'librarian_id' => $request->librarian_id,
            'date_returned' => $request->date_returned,
        ]);

        return redirect()->route('givebacks.index')->with('success', 'Giveback created successfully.');
    }

    public function show(Giveback $giveback)
    {
        return view('givebacks.show', compact('giveback'));
    }

    public function edit(Giveback $giveback)
    {
        $borroweds = Borrowed::all();
        $librarians = Librarian::all();
        return view('givebacks.edit', compact('giveback', 'borroweds', 'librarians'));
    }

    public function update(Request $request, Giveback $giveback)
    {
        $request->validate([
            'borrowed_id' => 'required|exists:borroweds,id',
            'librarian_id' => 'required|exists:librarians,id',
            'date_returned' => 'required|date',
        ]);

        $giveback->update([
            'borrowed_id' => $request->borrowed_id,
            'librarian_id' => $request->librarian_id,
            'date_returned' => $request->date_returned,
        ]);

        return redirect()->route('givebacks.index')->with('success', 'Giveback updated successfully.');
    }

    public function destroy(Giveback $giveback)
    {
        $giveback->delete();
        return redirect()->route('givebacks.index')->with('success', 'Giveback deleted successfully.');
    }
}
