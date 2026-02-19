<?php

// Web Routes
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('home');
});

// API routes
use App\Http\Controllers\ProductController;
Route::get('/api/products/featured', [ProductController::class, 'featured']);
Route::get('/api/products/{id}', [ProductController::class, 'show']);

// Admin routes
use App\Http\Controllers\Admin\ProductController as AdminProductController;
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});

// Toggle featured status
Route::patch(
  'admin/products/{product}/toggle-featured',
  [AdminProductController::class, 'toggleFeatured']
)->name('admin.products.toggleFeatured');
