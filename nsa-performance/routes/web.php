<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home');
});

Route::get('/api/products/featured', [ProductController::class, 'featured']);
Route::get('/api/products/{id}', [ProductController::class, 'show']);
