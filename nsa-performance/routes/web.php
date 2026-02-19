<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;

Auth::routes();

/* =======================================
 *  Admin routes with auth middleware
 * ======================================= */
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', fn() => redirect()->route('admin.products.index'));

        Route::resource('products', AdminProductController::class);
        Route::resource('articles', AdminArticleController::class);
        Route::resource('videos', AdminVideoController::class);

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

        // Toggle publish status for video
        Route::patch(
            '/videos/{video}/toggle-publish',
            [AdminVideoController::class, 'togglePublish']
        )->name('videos.toggle-publish');
    });


/* =======================
 *  Public routes
 * ======================= */

Route::get('/', fn() => view('home'));
Route::get('/api/products/featured', [ProductController::class, 'featured']);
Route::get('/api/products/{id}', [ProductController::class, 'show']);

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/api/articles/latest', [ArticleController::class, 'latest']);

Route::get('/api/videos/latest', [VideoController::class, 'latest']);
Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');
