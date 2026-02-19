<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\ArticleController;

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

        Route::get('/', fn() => redirect()->route('admin.products.index'));

        Route::resource('products', AdminProductController::class);
        Route::resource('articles', AdminArticleController::class);

        // Toggle featured status for product
        Route::patch(
            'products/{product}/toggle-featured',
            [AdminProductController::class, 'toggleFeatured']
        )->name('products.toggleFeatured');

        // Toggle publish status for article
        Route::patch(
            '/articles/{article}/toggle-publish',
            [AdminArticleController::class, 'togglePublish']
        )->name('admin.articles.toggle-publish');
    });

// List articles
Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');

// Detail article
Route::get('/articles/{slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

// API latest articles (homepage)
Route::get('/api/articles/latest', [ArticleController::class, 'latest']);
