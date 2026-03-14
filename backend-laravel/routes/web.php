<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// Frontend
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProdukController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Frontend\AlamatController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\DashboardController as FrontendDashboardController;

// Admin
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenjualanController;
use App\Http\Controllers\Admin\PrediksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProdukManajemenController;


/*
|--------------------------------------------------------------------------
| FRONTEND PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');


/*
|--------------------------------------------------------------------------
| CART (Guest Allowed)
|--------------------------------------------------------------------------
*/

Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/keranjang/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/keranjang/clear', [CartController::class, 'clear'])->name('cart.clear');


/*
|--------------------------------------------------------------------------
| AUTH FRONTEND (CUSTOMER)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/frontend/login', [AuthController::class, 'login'])->name('login');
    Route::post('/frontend/login', [AuthController::class, 'authenticate'])->name('login.process');
    Route::get('/frontend/register', [AuthController::class, 'register'])->name('register');
    Route::post('/frontend/register', [AuthController::class, 'storeRegister'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| FRONTEND AUTH AREA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/frontend/dashboard', [FrontendDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [OrderController::class, 'store'])
        ->name('checkout.store');
});


/*
|--------------------------------------------------------------------------
| NEWSLETTER
|--------------------------------------------------------------------------
*/

Route::get('/newsletter/subscribe', [NewsletterController::class, 'show'])
    ->name('newsletter.subscribe.form');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('/newsletter/verify/{token}', [NewsletterController::class, 'verify'])
    ->name('newsletter.verify');


/*
|--------------------------------------------------------------------------
| AUTH ADMIN (TERPISAH GUARD)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('guest:admin')
    ->group(function () {

        Route::get('/login', [AdminAuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AdminAuthController::class, 'login'])
            ->name('login.process');
    });

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| BACKEND ADMIN (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard (Semua Admin)
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Produk & Penjualan (Admin + Super Admin)
        |--------------------------------------------------------------------------
        */

        Route::middleware('admin.role:super_admin,admin')->group(function () {

            Route::resource('/produk', ProdukManajemenController::class);
            Route::resource('/penjualan', PenjualanController::class);

            Route::post('/penjualan/bulk-delete',
                [PenjualanController::class, 'bulkDelete'])
                ->name('penjualan.bulkDelete');

            Route::get('/prediksi', [PrediksiController::class, 'index'])
                ->name('prediksi.index');

            Route::post('/prediksi', [PrediksiController::class, 'proses'])
                ->name('prediksi.proses');

            Route::get('/laporan', [LaporanController::class, 'index'])
                ->name('laporan.index');

            Route::get('/laporan/export-excel',
                [LaporanController::class, 'exportExcel'])
                ->name('laporan.export.excel');

            Route::get('/model', [ModelController::class, 'index'])
                ->name('model.index');

            Route::get('/settings', [DashboardController::class, 'settings'])
                ->name('settings.index');
        });

        /*
        |--------------------------------------------------------------------------
        | Users (SUPER ADMIN ONLY)
        |--------------------------------------------------------------------------
        */

        Route::middleware('admin.role:super_admin')->group(function () {

            Route::get('/users', [UsersController::class, 'index'])
                ->name('users.index');
        });
    });