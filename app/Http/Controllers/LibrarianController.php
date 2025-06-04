<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LibrarianController extends Controller
{
    /**
     * Menampilkan semua pustakawan.
     */
    public function index()
    {
        $librarians = Librarian::all();
        return response()->json($librarians, 200);
    }

    /**
     * Menyimpan pustakawan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'librarian_name' => 'required|string',
            'address' => 'nullable|string',
            'librarian_phone' => 'required|string|unique:librarians,librarian_phone',
            'librarian_email' => 'required|email|unique:librarians,librarian_email',
            'password' => 'required|min:6',
        ]);

        $librarian = Librarian::create([
            'librarian_name' => $request->librarian_name,
            'address' => $request->address,
            'librarian_phone' => $request->librarian_phone,
            'librarian_email' => $request->librarian_email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Pustakawan berhasil ditambahkan',
            'librarian' => $librarian
        ], 201);
    }

    /**
     * Menampilkan detail pustakawan berdasarkan ID.
     */
    public function show($id)
    {
        $librarian = Librarian::find($id);

        if (!$librarian) {
            return response()->json(['message' => 'Pustakawan tidak ditemukan'], 404);
        }

        return response()->json($librarian, 200);
    }

    /**
     * Memperbarui pustakawan berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $librarian = Librarian::find($id);

        if (!$librarian) {
            return response()->json(['message' => 'Pustakawan tidak ditemukan'], 404);
        }

        $request->validate([
            'librarian_name' => 'sometimes|string',
            'address' => 'nullable|string',
            'librarian_phone' => 'sometimes|string|unique:librarians,librarian_phone,' . $id,
            'librarian_email' => 'sometimes|email|unique:librarians,librarian_email,' . $id,
            'password' => 'sometimes|min:6',
        ]);

        $librarian->update([
            'librarian_name' => $request->librarian_name ?? $librarian->librarian_name,
            'address' => $request->address ?? $librarian->address,
            'librarian_phone' => $request->librarian_phone ?? $librarian->librarian_phone,
            'librarian_email' => $request->librarian_email ?? $librarian->librarian_email,
            'password' => $request->password ? Hash::make($request->password) : $librarian->password,
        ]);

        return response()->json([
            'message' => 'Pustakawan berhasil diperbarui',
            'librarian' => $librarian
        ], 200);
    }

    /**
     * Menghapus pustakawan berdasarkan ID.
     */
    public function destroy($id)
    {
        $librarian = Librarian::find($id);

        if (!$librarian) {
            return response()->json(['message' => 'Pustakawan tidak ditemukan'], 404);
        }

        $librarian->delete();

        return response()->json(['message' => 'Pustakawan berhasil dihapus'], 200);
    }
}
