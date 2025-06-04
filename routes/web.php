<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\LibrarianAuthController;

// 🔓 LOGIN & REGISTER (user BIASA, belum login)
Route::get('/login', [WebController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebController::class, 'login']);
Route::get('/register', [WebController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [WebController::class, 'register']);

// 🔐 LOGOUT (user biasa yang sudah login)
Route::post('/logout', [WebController::class, 'logout'])->middleware('auth')->name('logout');

// 🔐 ROUTE khusus untuk USER BIASA yang sudah login
Route::middleware('auth')->group(function () {

    // Dashboard User biasa
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Books (view only)
    Route::prefix('books')->name('books.')->group(function () {
        Route::view('/', 'books.index')->name('index');
        Route::view('/create', 'books.create')->name('create');
        Route::view('/{id}/edit', 'books.edit')->name('edit'); // optional
    });

    // Genres
    Route::prefix('genres')->name('genres.')->group(function () {
        Route::view('/', 'genres.index')->name('index');
        Route::view('/create', 'genres.create')->name('create');
        Route::view('/{id}/edit', 'genres.edit')->name('edit'); // optional
    });

    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::view('/', 'users.index')->name('index');
        Route::view('/create', 'users.create')->name('create');
        Route::view('/{id}/edit', 'users.edit')->name('edit'); // optional
    });

    // Librarians
    Route::prefix('librarians')->name('librarians.')->group(function () {
        Route::view('/', 'librarians.index')->name('index');
        Route::view('/create', 'librarians.create')->name('create');
        Route::view('/{id}/edit', 'librarians.edit')->name('edit'); // optional
    });

    // Borroweds
    Route::prefix('borroweds')->name('borroweds.')->group(function () {
        Route::view('/', 'borroweds.index')->name('index');
    });

    // Givebacks
    Route::prefix('givebacks')->name('givebacks.')->group(function () {
        Route::view('/', 'givebacks.index')->name('index');
    });

});

// ================================================
// Routing untuk LIBRARIAN (admin perpustakaan)

// Login Librarian (tanpa middleware)
Route::get('/librarian/login', [LibrarianAuthController::class, 'showLoginForm'])->name('librarian.login');
Route::post('/librarian/login', [LibrarianAuthController::class, 'login']);

// Logout Librarian (gunakan middleware auth.librarian)
Route::post('/librarian/logout', [LibrarianAuthController::class, 'logout'])->middleware('auth.librarian')->name('librarian.logout');

// Dashboard dan resource librarian, proteksi dengan middleware 'auth.librarian' dan prefix 'librarian'
Route::middleware('auth.librarian')->prefix('librarian')->name('librarian.')->group(function () {
    Route::get('/dashboard', fn() => view('librarian.dashboard'))->name('dashboard');

    // Resource controller untuk buku, yang dikelola oleh librarian
    Route::resource('books', BookController::class);
});
