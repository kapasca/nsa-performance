<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Public
Route::get('/', fn() => view('home'));

Auth::routes();

Route::get('/api/products/featured', [ProductController::class, 'featured']);
Route::get('/api/products/{id}', [ProductController::class, 'show']);

// Admin
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', fn() => view('admin.dashboard'))
            ->name('dashboard');

        Route::resource('products', AdminProductController::class);

        Route::patch(
            'products/{product}/toggle-featured',
            [AdminProductController::class, 'toggleFeatured']
        )->name('products.toggleFeatured');
    });
