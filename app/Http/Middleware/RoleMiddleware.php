<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // $roles will automatically be an array of the comma-separated arguments passed to the middleware
        $allowedRoles = $roles;
        if (!auth()->check() || !in_array(auth()->user()->role, $allowedRoles, true)) {
            return redirect('products')->with('error', 'Akses ditolak. Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}
