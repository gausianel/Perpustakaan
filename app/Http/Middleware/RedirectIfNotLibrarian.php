<?php

// app/Http/Middleware/RedirectIfNotLibrarian.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotLibrarian
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('librarian')->check()) {
            return redirect()->route('librarian.login');
        }

        return $next($request);
    }
}

