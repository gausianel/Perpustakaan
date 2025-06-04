<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Exception;

class GenreController extends Controller
{
    // Get all genres
    public function index()
    {
        try {
            $genres = Genre::all();
            return response()->json($genres);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve genres', 'error' => $e->getMessage()], 500);
        }
    }

    // Get single genre
    public function show($id)
    {
        try {
            $genre = Genre::find($id);
            if (!$genre) {
                return response()->json(['message' => 'Genre not found'], 404);
            }
            return response()->json($genre);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve genre', 'error' => $e->getMessage()], 500);
        }
    }

    // Create new genre
    public function store(Request $request)
    {
        try {
            $request->validate([
                'genre_name' => 'required|string|max:255'
            ]);
            $genre = Genre::create($request->all());
            return response()->json($genre, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to create genre', 'error' => $e->getMessage()], 500);
        }
    }

    // Update genre
    public function update(Request $request, $id)
    {
        try {
            $genre = Genre::find($id);
            if (!$genre) {
                return response()->json(['message' => 'Genre not found'], 404);
            }
            $request->validate([
                'genre_name' => 'required|string|max:255'
            ]);
            $genre->update($request->all());
            return response()->json($genre);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update genre', 'error' => $e->getMessage()], 500);
        }
    }

    // Delete genre
    public function destroy($id)
    {
        try {
            $genre = Genre::find($id);
            if (!$genre) {
                return response()->json(['message' => 'Genre not found'], 404);
            }
            $genre->delete();
            return response()->json(['message' => 'Genre deleted']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete genre', 'error' => $e->getMessage()], 500);
        }
    }
}
