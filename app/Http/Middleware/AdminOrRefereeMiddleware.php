<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrRefereeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->is_admin || Auth::user()->is_referee)) {
            return $next($request);
        }

        return redirect('/'); // Redirect to home if not admin or referee
    }
}
