<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

/**
 * Public Routes
 */
Route::get('/', [ProductController::class, 'index'])
    ->name('home');
Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.product-detail');

/**
 * User Routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Admin Routes
 */
Route::prefix('/admin')
    ->middleware(['auth', IsAdmin::class])
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('categories', CategoryController::class);
    });

require __DIR__.'/auth.php';
