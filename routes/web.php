<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/manage', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');


Route::get('/', [App\Http\Controllers\FEController::class, 'index'])->name('index');
Route::get('/posts', [App\Http\Controllers\FEController::class, 'blog'])->name('posts');
Route::get('/poems', [App\Http\Controllers\FEController::class, 'poems'])->name('poems');
Route::get('/bookmarks', [App\Http\Controllers\FEController::class, 'bookmarks'])->name('bookmarks');
