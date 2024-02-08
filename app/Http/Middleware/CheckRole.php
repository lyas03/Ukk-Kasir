<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Memeriksa apakah pengguna memiliki peran yang diizinkan
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        return abort(403, 'Permission denied.');
    }
}
