<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCotroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::middleware('check_cart')->group(function () {

        Route::get('/catalog', [ProductController::class, 'index'])->name('products.index');
        Route::get('/catalog/{product}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.show');

        Route::post('/catalog/addToCart/{product}', [CartController::class, 'store'])->name('cart.add');
        Route::delete('/cart/deleteItem/{cartItem}', [CartController::class, 'deleteCartItem'])->name('delete.cartItem');
        Route::patch('/cart/{itemId}/{action}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

        Route::middleware(['admin'])->group(function () {

            Route::get('/adminpanel', [AdminController::class, 'index'])->name('admin.adminpanel');
            Route::delete('/adminpanel/brand/{brand}', [AdminController::class, 'deleteBrand'])->name('admin.deleteBrand');
            Route::delete('/catalog/{product}', [AdminController::class, 'deleteProduct'])->name('deleteProduct.adminpanel');

            Route::get('/catalog/{product}/edit', [AdminController::class, 'editProductPage'])->name('product.editPage');
            Route::put('/catalog/{product}/edit', [AdminController::class, 'updateProduct'])->name('product.update');


            Route::get('/adminpanel/createProduct', [AdminController::class, 'createProductPage'])->name('admin.createProductPage');

            Route::post('/adminpanel/createProduct', [AdminController::class, 'storeProducts'])->name('admin.createProduct');

            Route::post('/adminpanel/createBrand', [AdminController::class, 'storeBrand'])->name('admin.createBrand');
            Route::post('/adminpanel/deleteAllBrands', [AdminController::class, 'deleteAllBrands'])->name('admin.deleteAllBrand');
        });
    });
});






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
