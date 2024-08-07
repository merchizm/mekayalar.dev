<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\API\ClapController;
use App\Http\Controllers\API\RaindropController;
use App\Http\Controllers\API\SpotifyController;
use Illuminate\Support\Facades\Route;
use SoftinkLab\LaravelKeyvalueStorage\Facades\KVOption;

Route::get('/get-claps', [ClapController::class, 'getClaps']);
Route::post('/update-claps', [ClapController::class, 'updateClaps']);


/**
 * Spotify End-points
 * Let's leave the security pillars aside for now.
 */

Route::group(['as' => 'spotify.', 'prefix' => 'spotify'], function () {
    // authentication
    Route::get('authorize', [SpotifyController::class, 'authToSpotify']);
    Route::get('callback', [SpotifyController::class, 'callback']);

    // others
    Route::get('playing', [SpotifyController::class, 'playing']);
    Route::get('playlists', [SpotifyController::class, 'playlists']);

    Route::get('test', function(){
       return KVOption::get('spotify_access_token');
    });
});


/**
 * Raindrop End-points
 */

Route::group(['as' => 'raindrop.', 'prefix' => 'raindrop'], function(){
    Route::get('authorize', [RaindropController::class, 'authToRain']);
    Route::get('callback', [RaindropController::class, 'callback']);
});

