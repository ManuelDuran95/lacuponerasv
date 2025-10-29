<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle($request, Closure $next, $rolNecesario)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        if (Auth::user()->rol !== $rolNecesario) {
            abort(403, 'No autorizado');
        }

        return $next($request);
    }
}
