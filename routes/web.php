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
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/api/products/{product}', [ProductController::class, 'jsonDetail'])->name('api.products.detail');

// 2. Bilingual Locale Switcher (EN / ID)
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// 3. Inside Team Admin Portal Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Auth
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    });

    // Authenticated Team Members
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/tokopedia/sync', [DashboardController::class, 'triggerSync'])->name('tokopedia.sync');
        Route::post('/tokopedia/scrape', [DashboardController::class, 'triggerScrape'])->name('tokopedia.scrape');

        // Product Management
        Route::resource('products', AdminProductController::class);

        // Content & Banner Management
        Route::get('/contents', [AdminContentController::class, 'index'])->name('contents.index');
        Route::post('/contents', [AdminContentController::class, 'update'])->name('contents.update');
    });
});
