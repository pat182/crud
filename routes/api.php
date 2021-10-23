<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{ArtistController,AlbumsController,TracksController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//artis
Route::post('/artist/fillter',[ArtistController::class,"artistFillter"]);
Route::resource('/artist',ArtistController::class);
///albums
Route::resource('/albums',AlbumsController::class);
//tracks
Route::resource('/tracks',TracksController::class);

