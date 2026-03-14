<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {

        /*
        |--------------------------------------------------------------------------
        | Redirect Guest (Multi Login Support)
        |--------------------------------------------------------------------------
        |
        | Jika user belum login dan mencoba akses route protected,
        | kita arahkan sesuai area (admin / frontend)
        |
        */

        $middleware->redirectGuestsTo(function (Request $request) {

            // Jika akses area admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            // Default login frontend
            return route('login');
        });

        /*
        |--------------------------------------------------------------------------
        | Custom Middleware Alias (Untuk Role System)
        |--------------------------------------------------------------------------
        |
        | Ini penting untuk sistem role nanti
        |
        */

        $middleware->alias([
            'admin.role' => \App\Http\Middleware\AdminRoleMiddleware::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();