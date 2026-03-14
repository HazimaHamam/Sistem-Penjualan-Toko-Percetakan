<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\AdminRole;

class AdminRoleMiddleware
{
    public function handle($request, \Closure $next, ...$roles)
{
    $admin = Auth::guard('admin')->user();

    if (!$admin) {
        abort(403);
    }

    $enumRoles = collect($roles)
        ->map(fn ($role) => AdminRole::from($role))
        ->toArray();

    if (!in_array($admin->role, $enumRoles, true)) {
        abort(403);
    }

    return $next($request);
}
    
}