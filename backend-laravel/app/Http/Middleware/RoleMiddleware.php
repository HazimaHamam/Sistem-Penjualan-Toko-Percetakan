<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usage:
     * ->middleware(['auth', 'role:admin'])
     */
    public function handle(Request $request, Closure $next, string $role, string $guard = null): Response
{
    $guard = $guard ?? config('auth.defaults.guard');

    if (!auth()->guard($guard)->check()) {
        abort(403, 'Unauthorized');
    }

    $user = auth()->guard($guard)->user();

    if ($user->role !== $role) {
        abort(403, 'Access denied');
    }

    return $next($request);
}
}