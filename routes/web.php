<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Models\Category;
use App\Models\Product;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

/**
 * Public Routes
 */
Route::get('/', function () {
    return redirect()->route('products.index');
})->name('home');

Route::get('/products', function (Request $request) {
    $products = Product::query()
        ->when($request->filled('q'), function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->string('q').'%');
        })->get();

    return view('home', compact('products'));
})->name('products.index');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.product-detail');
Route::get('/categories/{category:slug}/products', function (Request $request, Category $category) {
    $products = $category->products()
        ->when($request->filled('q'), function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->string('q').'%');
        })->get();

    return view('home', [
        'products' => $products,
        'category' => $category
    ]);
})->name('categories.products');

/**
 * User Routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [UserOrderController::class, 'store'])->name('orders.store');
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

        Route::resource('products', ProductController::class);

        Route::resource('categories', CategoryController::class);

        // Route::resource('orders', OrderController::class);
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');
    });

require __DIR__.'/auth.php';
