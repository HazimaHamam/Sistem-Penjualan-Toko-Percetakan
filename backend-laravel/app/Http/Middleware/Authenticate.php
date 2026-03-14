<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Redirect user jika belum login
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {

            // Jika akses area admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            // Default ke login frontend
            return route('login');
        }

        return null;
    }
}