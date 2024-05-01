<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\SpotifyController;
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
