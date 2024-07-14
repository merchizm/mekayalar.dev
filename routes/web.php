<?php

use Illuminate\Support\Facades\Auth;
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
 * Manager Routes
 */
