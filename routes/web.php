<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/manage', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');


Route::get('/', [App\Http\Controllers\FEController::class, 'index'])->name('index');
