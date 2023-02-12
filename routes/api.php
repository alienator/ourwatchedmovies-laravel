<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;

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


Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/logout', [AuthController::class, 'logout']);
Route::get('/v1/isUserLoged', [AuthController::class, 'isUserLoged']);

Route::get('/v1/movie', [MovieController::class, 'find']);
Route::get('/v1/movie/{id}', [MovieController::class, 'details']);
Route::post('/v1/movie', [MovieController::class, 'edit']);

Route::post('/v1/comment', [CommentController::class, 'save']);
Route::post('/v1/comment/{id}', [CommentController::class, 'save']);
Route::get('/v1/comment', [CommentController::class, 'findByMovieId']);
Route::get('/v1/comment/{id}', [CommentController::class, 'findById']);

Route::post('/v1/score', [ScoreController::class, 'save']);
Route::post('/v1/score/{id}', [ScoreController::class, 'save']);
Route::get('/v1/score', [ScoreController::class, 'findByMovieId']);
Route::get('/v1/score/{id}', [ScoreController::class, 'findById']);

Route::post('/v1/user', [UserController::class, 'save']);
Route::get('/v1/user/{id}', [UserController::class, 'findById']);
