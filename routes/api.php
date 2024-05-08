<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoriteBookController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', [AuthController::class, 'sign_up']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //member routes
    Route::controller(FavoriteBookController::class)->group(function () {
        Route::get('favorites', 'index');
        Route::post('favorite/{id}', 'store');
        Route::delete('favorite/{id}', 'destroy');
    }); 

    Route::controller(ReviewController::class)->group(function () {
        Route::get('reviews', 'index');
        Route::post('review/{id}', 'store');
        Route::put('review/{id}', 'update');
        Route::delete('review/{id}', 'destroy');
    }); 
});

//user route
Route::get('/all_books', [BookController::class, 'all_books']);
Route::get('/search/{id}', [BookController::class, 'search']);






