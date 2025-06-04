<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibrarianAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.librarian-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::guard('librarian')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/librarian/dashboard');
        }

        return back()->withErrors([
            'name' => 'Login gagal. Nama atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('librarian')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('librarian.login');
    }
}
