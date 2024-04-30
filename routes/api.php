<?php

use App\Http\Controllers\ClapController;
use Illuminate\Support\Facades\Route;

Route::get('/api/get-claps', [ClapController::class, 'getClaps']);
Route::post('/api/update-claps', [ClapController::class, 'updateClaps']);
