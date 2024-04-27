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
Route::get('/games', [GameController::class, 'displayGames'])->middleware('authCheck'); //reroute to backlog
Route::get('/stats', [GameController::class, 'stats'])->middleware('authCheck');
Route::get('/login', function () { return view('login'); });
Route::get('/signup', function () { return view('sign_up'); });
Route::get('/aidenredmond', function() { return view('aidenredmond'); });
Route::get('/add', function() { return view('add'); })->middleware('authCheck');
Route::get('/about', function() { return view('about'); });

//GAME ROUTES
Route::get('/games/{desc}', [GameController::class, 'displayGames'])->middleware('authCheck');
Route::get('/games/delete/{id}', [GameController::class, 'destroy'])->middleware('authCheck');
Route::get('/games/update/{id}', [GameController::class, 'update'])->middleware('authCheck');
Route::get('/games/{desc}/sortby={sortby_field}', [GameController::class, 'sort'])->middleware('authCheck');

// ADD GAME
Route::post('/add', [GameController::class, 'store']);

// SESSIONS
Route::post('/signup', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);