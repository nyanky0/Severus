<?php

use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// 1. Customer Public Landing & Marketing Pages
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/api/products/{product}', [ProductController::class, 'jsonDetail'])->name('api.products.detail');

// 2. Bilingual Locale Switcher (EN / ID)
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// 3. Fallback Route Named 'login' for Laravel Auth Middleware Redirect
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');

// 4. Inside Team Admin Portal Routes with Rate Limiting & Auth Protection
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Auth with Rate Limiter (6 attempts per minute to prevent brute-force & SQL injection probes)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])
            ->middleware('throttle:6,1')
            ->name('login.submit');
    });

    // Authenticated Team Members (Redirects guests to /admin/login)
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // Product Management (Manual Add, Edit, Delete by Team)
        Route::resource('products', AdminProductController::class);

        // Content & Banner Management
        Route::get('/contents', [AdminContentController::class, 'index'])->name('contents.index');
        Route::post('/contents', [AdminContentController::class, 'update'])->name('contents.update');
    });
});
