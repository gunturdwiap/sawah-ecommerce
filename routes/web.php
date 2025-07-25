<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
/**
 * Public Routes
 */
Route::get('/', function () {
    return redirect()->route('products.index');
})->name('home');

Route::get('/products', function () {
    $products = Product::all();
    return view('home', compact('products'));
})->name('products.index');
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

        Route::get('/', AdminDashboardController::class)
            ->name('dashboard');

        // Route::controller(ProductController::class)->group(function () {
        //     Route::get('/products', 'products')->name('products.index');
        //     Route::get('/products/create', 'create')->name('products.create');
        //     Route::post('/products', 'store')->name('products.store');
        //     Route::get('/products/{id}/edit', 'edit')->name('products.edit');
        //     Route::put('/products/{product}', 'update')->name('products.update');
        //     Route::delete('/products/{id}', 'destroy')->name('products.destroy');
        // });
        Route::resource('products', ProductController::class);

        Route::resource('categories', CategoryController::class);
    });

require __DIR__.'/auth.php';
