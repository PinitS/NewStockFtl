<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\BranchSessionController;




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


    Route::prefix('branches')->group(function () {
        Route::get('/', function () {
            return view('pages.manage.branch.index');
        });
        Route::get('getBranches', [BranchController::class, 'getBranches'])->name('getBranches');
        Route::get('getBranch/{id}', [BranchController::class, 'getBranch'])->name('getBranch');
        Route::post('create', [BranchController::class, 'create'])->name('createBranch');
        Route::post('update/{id}', [BranchController::class, 'update']);
        Route::get('destroy/{id}', [BranchController::class, 'delete']);
    });
});


Route::prefix('stock')->group(function () {
    Route::prefix('parts')->group(function () {
        Route::get('/', function () {
            return view('pages.stock.parts.index');
        });
        Route::post('getParts', [PartController::class, 'getParts'])->name('getParts');

        Route::get('getOnePart/{id}', [PartController::class, 'getOnePart']);
        Route::post('create', [PartController::class, 'create'])->name('createParts');

        Route::post('changeQuantity/{id}', [PartController::class, 'changeQuantity']);
        Route::get('getPartHistory/{id}', [PartController::class, 'getPartHistory']);

        Route::post('update/{id}', [PartController::class, 'update']);
        Route::get('destroy/{id}', [PartController::class, 'delete']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', function () {
            return view('pages.stock.category.index');
        });
        Route::get('getCategories', [CategoryController::class, 'getCategories'])->name('getCategories');
        Route::get('getCategory/{id}', [CategoryController::class, 'getCategory'])->name('getCategory');
        Route::post('create', [CategoryController::class, 'create'])->name('createCategory');
        Route::post('update/{id}', [CategoryController::class, 'update']);
        Route::get('destroy/{id}', [CategoryController::class, 'delete']);
    });
});



//Session branch
Route::get('/selectBranch', function () {
    return view('pages.selectBranch.index');
});
Route::post('getSessionBranch', [BranchSessionController::class, 'getSessionBranch'])->name('getSessionBranch');
Route::get('removeSessionBranch', [BranchSessionController::class, 'removeSessionBranch'])->name('removeSessionBranch');
//end Session branch



Route::get('/original', function () {
    return view('original');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
