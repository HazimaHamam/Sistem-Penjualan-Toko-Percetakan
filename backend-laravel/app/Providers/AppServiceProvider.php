<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Enums\AdminRole;
use App\Models\Penjualan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Route Macro: adminRole()
        |--------------------------------------------------------------------------
        */

        Route::macro('adminRole', function (AdminRole ...$roles) {
            /** @var \Illuminate\Routing\Route $this */
            $values = collect($roles)
                ->map(fn ($role) => $role->value)
                ->implode(',');

            return $this->middleware("admin.role:{$values}");
        });

        /*
        |--------------------------------------------------------------------------
        | Global View Composer (Notifikasi Penjualan)
        |--------------------------------------------------------------------------
        */

        View::composer('*', function ($view) {
            $jumlahNotifikasi = Penjualan::where('status', 'Pending')->count();
            $view->with('jumlahNotifikasi', $jumlahNotifikasi);
        });
    }
}