<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// BASIC ROUTES
Route::get('/', function () { return view('index'); });
Route::get('/games', [GameController::class, 'index'])->middleware('authCheck');
Route::get('/stats', [GameController::class, 'stats'])->middleware('authCheck');
Route::get('/login', function () { return view('login'); });
Route::get('/signup', function () { return view('sign_up'); });
Route::get('/aidenredmond', function() { return view('aidenredmond'); });
Route::get('/add', function() { return view('add'); })->middleware('authCheck');

// this needs to be fixed because it's gonna catch the same things as the game routes, except deny access since it thinks its a game ID
// Route::get('/all_games/{id}', [GameController::class, 'gameUpdate'])->middleware('authCheck');

//GAME ROUTES
Route::get('/games/{desc}', [GameController::class, 'displayGames'])->middleware('authCheck');
Route::get('/games/delete/{id}', [GameController::class, 'destroy'])->middleware('authCheck');

// ADD GAME
Route::post('/add', [GameController::class, 'store']);

// ADD USERS & LOGIN/ETC
Route::post('/signup', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);