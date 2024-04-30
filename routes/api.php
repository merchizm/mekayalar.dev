<?php

use App\Http\Controllers\ClapController;
use Illuminate\Support\Facades\Route;

Route::get('/get-claps', [ClapController::class, 'getClaps']);
Route::post('/update-claps', [ClapController::class, 'updateClaps']);
