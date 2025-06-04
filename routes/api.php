<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    BookController,
    BorrowedController,
    GivebackController,
    GenreController,
    LibrarianController,
    Controller as UserController,
    ApiController
};

// 🔓 Login/Register untuk API
Route::post('/register', [ApiController::class, 'apiRegister']);
Route::post('/login', [ApiController::class, 'login']);
Route::post('/librarian/login', [ApiController::class, 'librarianLogin']);

// 🔐 Hanya user login yang bisa akses ini
Route::middleware('auth:sanctum')->group(function () {

    // Ambil data user login
    Route::get('/user', fn(Request $request) => $request->user());

    // Logout umum
    Route::post('/logout', [ApiController::class, 'logout']);

    // Logout khusus librarian
    Route::post('/librarian/logout', [ApiController::class, 'librarianLogout']);

    // User management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // Books
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index']);
        Route::post('/', [BookController::class, 'store']);
        Route::get('/{id}', [BookController::class, 'show']);
        Route::put('/{id}', [BookController::class, 'update']);
        Route::delete('/{id}', [BookController::class, 'destroy']);
    });

    // Borroweds
    Route::prefix('borroweds')->group(function () {
        Route::get('/', [BorrowedController::class, 'index']);
        Route::post('/', [BorrowedController::class, 'store']);
        Route::get('/{id}', [BorrowedController::class, 'show']);
        Route::put('/{id}', [BorrowedController::class, 'update']);
        Route::delete('/{id}', [BorrowedController::class, 'destroy']);
    });

    // Givebacks
    Route::prefix('givebacks')->group(function () {
        Route::get('/', [GivebackController::class, 'index']);
        Route::post('/', [GivebackController::class, 'store']);
        Route::get('/{id}', [GivebackController::class, 'show']);
        Route::put('/{id}', [GivebackController::class, 'update']);
        Route::delete('/{id}', [GivebackController::class, 'destroy']);
    });

    // Genres
    Route::prefix('genres')->group(function () {
        Route::get('/', [GenreController::class, 'index']);
        Route::post('/', [GenreController::class, 'store']);
        Route::get('/{id}', [GenreController::class, 'show']);
        Route::put('/{id}', [GenreController::class, 'update']);
        Route::delete('/{id}', [GenreController::class, 'destroy']);
    });

    // Librarians
    Route::prefix('librarians')->group(function () {
        Route::get('/', [LibrarianController::class, 'index']);
        Route::post('/', [LibrarianController::class, 'store']);
        Route::get('/{id}', [LibrarianController::class, 'show']);
        Route::put('/{id}', [LibrarianController::class, 'update']);
        Route::delete('/{id}', [LibrarianController::class, 'destroy']);
    });

});
