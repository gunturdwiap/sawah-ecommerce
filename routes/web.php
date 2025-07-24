<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('/admin')->middleware(['auth', IsAdmin::class])->group(function () {

    Route::get('/', fn () => 'Secret admin panel')
        ->name('admin.index');

        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/table/product', 'tableproduct')->name('product.tableproduct');
            Route::get('/product', 'product');

            Route::post('/product', 'store')->name('product.store'); 
            Route::get('/product/get/{id}', 'get')->name('product.get'); 
            Route::put('/product/{id}', 'update')->name('product.update');
            Route::delete('/product/{id}', 'destroy')->name('product.destroy');
        });

});

require __DIR__.'/auth.php';
