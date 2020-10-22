<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\BranchSessionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationModelController;
use App\Http\Controllers\LocationProductController;
use App\Http\Controllers\LocationProductDetailController;
use App\Http\Controllers\ProductPartsController;
use App\Http\Controllers\CustomerSessionController;
use App\Http\Controllers\GroupPartsController;

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

    Route::prefix('product_location')->group(function () {
        Route::prefix('location')->group(function () {
            Route::get('/', function () {
                return view('pages.manage.product_location.location.index');
            });
            Route::get('getLocations', [LocationController::class, 'getLocations'])->name('getLocations');
            Route::get('getOneLocation/{id}', [LocationController::class, 'getOneLocation']);
            Route::post('create', [LocationController::class, 'create'])->name('createLocation');
            Route::post('update/{id}', [LocationController::class, 'update']);
            Route::get('destroy/{id}', [LocationController::class, 'delete']);
        });

        Route::prefix('model')->group(function () {
            Route::get('/', function () {
                return view('pages.manage.product_location.model.index');
            });
            Route::get('getLocationModels', [LocationModelController::class, 'getLocationModels'])->name('getLocationModels');
            Route::get('getOneLocationModel/{id}', [LocationModelController::class, 'getOneLocationModel']);
            Route::post('create', [LocationModelController::class, 'create'])->name('createLocationModel');
            Route::post('update/{id}', [LocationModelController::class, 'update']);
            Route::get('destroy/{id}', [LocationModelController::class, 'delete']);
        });
    });

    Route::prefix('groupParts')->group(function () {
        Route::get('/', function () {
            return view('pages.manage.groupParts.index');
        });
        Route::get('getGroups', [GroupPartsController::class, 'getGroups']);
        Route::get('getOneGroup/{id}', [GroupPartsController::class, 'getOneGroup']);
        Route::post('update/{id}', [GroupPartsController::class, 'update']);
        Route::get('destroy/{id}', [GroupPartsController::class, 'delete']);
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


Route::prefix('customer')->group(function () {
    Route::get('/', function () {
        return view('pages.customer.productList.index');
    });
    Route::get('getCategories', [CategoryController::class, 'getCategories'])->name('getCategories');
    Route::get('getCategory/{id}', [CategoryController::class, 'getCategory'])->name('getCategory');
    Route::post('create', [CategoryController::class, 'create'])->name('createCategory');
    Route::post('update/{id}', [CategoryController::class, 'update']);
    Route::get('destroy/{id}', [CategoryController::class, 'delete']);
});


Route::prefix('product_location')->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('/', function () {
            return view('pages.product_location.product.index');
        });
        Route::get('getProducts', [LocationProductController::class, 'getProducts'])->name('getProducts');
        Route::get('getOneProduct/{id}', [LocationProductController::class, 'getOneProduct']);
        Route::post('create', [LocationProductController::class, 'create'])->name('createProduct');
        Route::post('update/{id}', [LocationProductController::class, 'update']);
        Route::get('destroy/{id}', [LocationProductController::class, 'delete']);

    });

    Route::prefix('productPart')->group(function () {
        Route::get('getProductParts/{id}', [ProductPartsController::class, 'getProductParts']);
        Route::get('getOneProductParts/{id}', [ProductPartsController::class, 'getOneProductParts']);
        Route::post('create', [ProductPartsController::class, 'create'])->name('createProductParts');
        Route::post('update/{id}', [ProductPartsController::class, 'update']);
        Route::get('delete/{id}', [ProductPartsController::class, 'delete']);

    });

    Route::prefix('product_detail')->group(function () {
        Route::get('/', function () {
            return view('pages.product_location.detail.index');
        });
        Route::get('getDetails', [LocationProductDetailController::class, 'getDetails'])->name('getDetails');
        Route::get('getOneDetail/{id}', [LocationProductDetailController::class, 'getOneDetail'])->name('getOneDetail');
        Route::post('create', [LocationProductDetailController::class, 'create'])->name('createDetail');
        Route::post('update/{id}', [LocationProductDetailController::class, 'update']);
        Route::get('destroy/{id}', [LocationProductDetailController::class, 'delete']);
        Route::post('changeStatus/{id}', [LocationProductDetailController::class, 'changeStatus']);
    });
});


//Session branch
Route::get('/selectBranch', function () {
    return view('pages.selectBranch.index');
});
Route::post('getSessionBranch', [BranchSessionController::class, 'getSessionBranch'])->name('getSessionBranch');
Route::get('removeSessionBranch', [BranchSessionController::class, 'removeSessionBranch'])->name('removeSessionBranch');
//end Session branch

//Session customer
Route::get('/selectCustomer', function () {
    return view('pages.selectCustomer.index');
});
Route::post('getSessionCustomer', [CustomerSessionController::class, 'getSessionCustomer'])->name('getSessionCustomer');
Route::get('removeSessionCustomer', [CustomerSessionController::class, 'removeSessionCustomer'])->name('removeSessionCustomer');
//end Session customer


Route::get('/original', function () {
    return view('original');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
