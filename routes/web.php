<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\Front\IndexController::class, 'index'])->name('index');
Route::get('/posts', [App\Http\Controllers\Front\BlogController::class, 'index'])->name('posts');

Route::get('/poems', [App\Http\Controllers\Front\PoemController::class, 'index'])->name('poems');
Route::get('/poems/{slug}', [App\Http\Controllers\Front\PoemController::class, 'show'])->name('poems.show');
Route::get('/bookmarks', [App\Http\Controllers\Front\BookmarkController::class, 'index'])->name('bookmarks');

/**
 * Authentication Routes
 */
Route::get('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'loginPage'])->name('login');
Route::post('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('auth/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


/**
 * Manager/Admin Routes
 */
Route::prefix('panel')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    /**
     * Post/Blog End-points
     */
    Route::get('posts', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('posts');
    Route::get('posts-create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('posts.create');


    /**
     * Category End-points
     */
    Route::get('categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories');
    Route::resource('categories',App\Http\Controllers\Admin\CategoryController::class)->except(['create', 'edit', 'index']);
    // burayı böyle neden yaptım bilmiyorum ama hoşuma da gitti kaldırmayacağım :D


    /**
     * Poem End-points
     */
    Route::resource('poems', App\Http\Controllers\Admin\PoemController::class)->except(['create', 'edit']);
});
