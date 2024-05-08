<?php

use App\Models\Book;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MainCategoryController;

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

Route::get('/', function () {
    return view('Auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('MainCategory', MainCategoryController::class);
Route::get('find_MainCategory', [MainCategoryController::class, 'find_MainCategory'])->name('find_MainCategory');


Route::resource('SubCategory', SubCategoryController::class);
Route::get('find_SubCategory', [SubCategoryController::class, 'find_SubCategory'])->name('find_SubCategory');


Route::resource('Book', BookController::class);
Route::get('find_Book', [BookController::class, 'find_Book'])->name('find_Book');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
