<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('manage')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/', function () {
            return view('pages.manage.user.index');
        });
        Route::get('getUsers', [UserController::class, 'getUsers'])->name('getUsers');
        Route::get('oneUser/{id}', [UserController::class, 'getOneUser'])->name('oneUser');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [UserController::class, 'delete'])->name('destroy');
        Route::post('resetPassword/{id}', [UserController::class, 'resetPassword'])->name('resetPassword');
        Route::post('create', [UserController::class, 'create'])->name('createUser');
    });


    Route::prefix('categories')->group(function () {
        Route::get('/', function () {
            return view('pages.manage.category.index');
        });
        Route::get('getCategories', [CategoryController::class, 'getCategories'])->name('getCategories');
        Route::get('getCategory/{id}', [CategoryController::class, 'getCategory'])->name('getCategory');
        Route::post('create', [CategoryController::class, 'create'])->name('createCategory');
        Route::post('update/{id}', [CategoryController::class, 'update']);
        Route::get('destroy/{id}', [CategoryController::class, 'delete']);
    });

});















Route::get('/original', function () {
    return view('original');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
