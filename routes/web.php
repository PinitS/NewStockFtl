<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
use App\Http\Controllers\CalProductsController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\DealerSessionController;
use App\Http\Controllers\DealerProductController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\UnitPartsController;


use Illuminate\Support\Facades\App;


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

Route::middleware(['hasAuth'])->get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

//    Route::get('setLocale/{locale}', function ($locale) {
//        Session::put('locale', $locale);
//        return redirect()->back();
//    });
    Route::get('setLocale/{locale}', [languageController::class, 'setLocale']);


    Route::group(['middleware' => 'language'], function () {
        Route::prefix('manage')->group(function () {
            Route::prefix('users')->group(function () {
                Route::middleware(['adminRoute'])->get('/', function () {
                    return view('pages.manage.user.index');
                });
                Route::get('getUsers', [UserController::class, 'getUsers'])->name('getUsers');
                Route::get('oneUser/{id}', [UserController::class, 'getOneUser'])->name('oneUser');
                Route::post('update/{id}', [UserController::class, 'update'])->name('update');
                Route::get('destroy/{id}', [UserController::class, 'delete'])->name('destroy');
                Route::post('resetPassword/{id}', [UserController::class, 'resetPassword'])->name('resetPassword');
                Route::post('create', [UserController::class, 'create'])->name('createUser');
                Route::post('changeActive/{id}', [UserController::class, 'changeActive']);

            });

            Route::prefix('branches')->group(function () {
                Route::middleware(['adminRoute'])->get('/', function () {
                    return view('pages.manage.branch.index');
                });
                Route::get('getBranches', [BranchController::class, 'getBranches'])->name('getBranches');
                Route::get('getBranch/{id}', [BranchController::class, 'getBranch'])->name('getBranch');
                Route::post('create', [BranchController::class, 'create'])->name('createBranch');
                Route::post('update/{id}', [BranchController::class, 'update']);
                Route::get('destroy/{id}', [BranchController::class, 'delete']);
            });

            Route::prefix('dealer')->group(function () {
                Route::middleware(['adminRoute'])->get('/', function () {
                    return view('pages.manage.dealer.index');
                });
                Route::get('getDealers', [DealerController::class, 'getDealers']);
                Route::get('getOneDealer/{id}', [DealerController::class, 'getOneDealer']);
                Route::post('create', [DealerController::class, 'create']);
                Route::post('update/{id}', [DealerController::class, 'update']);
                Route::get('destroy/{id}', [DealerController::class, 'delete']);
            });

            Route::prefix('location')->group(function () {
                Route::middleware(['adminRoute'])->get('/', function () {
                    return view('pages.manage.location.index');
                });
                Route::get('getLocations', [LocationController::class, 'getLocations'])->name('getLocations');
                Route::get('getOneLocation/{id}', [LocationController::class, 'getOneLocation']);
                Route::post('create', [LocationController::class, 'create'])->name('createLocation');
                Route::post('update/{id}', [LocationController::class, 'update']);
                Route::get('destroy/{id}', [LocationController::class, 'delete']);
            });

            Route::prefix('model')->group(function () {
                Route::middleware(['adminRoute'])->get('/', function () {
                    return view('pages.manage.model.index');
                });
                Route::get('getLocationModels', [LocationModelController::class, 'getLocationModels'])->name('getLocationModels');
                Route::get('getOneLocationModel/{id}', [LocationModelController::class, 'getOneLocationModel']);
                Route::post('create', [LocationModelController::class, 'create'])->name('createLocationModel');
                Route::post('update/{id}', [LocationModelController::class, 'update']);
                Route::get('destroy/{id}', [LocationModelController::class, 'delete']);
            });

            Route::prefix('groupParts')->group(function () {
                Route::middleware(['adminRoute'])->get('/', function () {
                    return view('pages.manage.groupParts.index');
                });
                Route::get('getGroups', [GroupPartsController::class, 'getGroups']);
                Route::get('getOneGroup/{id}', [GroupPartsController::class, 'getOneGroup']);
                Route::post('create', [GroupPartsController::class, 'create']);
                Route::post('update/{id}', [GroupPartsController::class, 'update']);
                Route::get('destroy/{id}', [GroupPartsController::class, 'delete']);
            });

            Route::prefix('unitParts')->group(function () {
                Route::middleware(['adminRoute'])->get('/', function () {
                    return view('pages.manage.unitParts.index');
                });
                Route::get('getUnits', [UnitPartsController::class, 'getUnits']);
                Route::get('getOneUnit/{id}', [UnitPartsController::class, 'getOneUnit']);
                Route::post('create', [UnitPartsController::class, 'create']);
                Route::post('update/{id}', [UnitPartsController::class, 'update']);
                Route::get('destroy/{id}', [UnitPartsController::class, 'delete']);
            });

        });

        Route::prefix('stock')->middleware(['nullBranchSession'])->group(function () {
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

                Route::get('getOneInHistory/{id}', [PartController::class, 'getOneInHistory']);
                Route::post('updateOneHistory/{id}', [PartController::class, 'updateOneHistory']);


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


        Route::prefix('customer')->middleware(['nullCustomerSession'])->group(function () {
            Route::get('/', function () {
                return view('pages.customer.productList.index');
            });
        });

        Route::prefix('dealer')->middleware(['nullDealerSession'])->group(function () {
            Route::get('/', function () {
                return view('pages.dealer.index');
            });
            Route::get('getDealerProductHistory/{id}', [DealerProductController::class, 'getDealerProductHistory']);
            Route::get('getDealerProductById/{id}', [DealerProductController::class, 'getDealerProductById']);
            Route::get('getProductInDealer/{id}', [DealerProductController::class, 'getProductInDealer']);

            Route::post('create', [DealerProductController::class, 'create']);
            Route::post('addQuantity/{id}', [DealerProductController::class, 'addQuantity']);
            Route::get('destroy/{id}', [DealerProductController::class, 'delete']);
            Route::prefix('dealerCustomer')->group(function () {
                Route::get('/', function () {
                    return view('pages.dealer.dealerCustomer.index');
                });
            });
        });

        Route::prefix('dealerSell')->group(function () {
            Route::get('/', function () {
                return view('pages.dealerSell.index');
            });
            Route::get('getProductInDealer/{id}&{dId}', [DealerProductController::class, 'getProductInDealer']);
            Route::get('getDropdownSell', [DealerProductController::class, 'getDropdownSell']);
            Route::get('getDropdownSellProduct/{id}', [DealerProductController::class, 'getDropdownSellProduct']);
            Route::get('getDropdownSell', [DealerProductController::class, 'getDropdownSell']);
            Route::post('dealerSold', [DealerProductController::class, 'dealerSold']);


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

                Route::get('getDetails', [LocationProductDetailController::class, 'getDetails'])->name('getDetails');
                Route::get('getOneDetail/{id}', [LocationProductDetailController::class, 'getOneDetail'])->name('getOneDetail');
                Route::post('create', [LocationProductDetailController::class, 'create'])->name('createDetail');
                Route::post('update/{id}', [LocationProductDetailController::class, 'update']);
                Route::get('destroy/{id}', [LocationProductDetailController::class, 'delete']);
                Route::post('changeStatus/{id}', [LocationProductDetailController::class, 'changeStatus']);
                Route::get('getDropdown', [LocationProductDetailController::class, 'getDropdown']);

            });
        });

        Route::prefix('report')->group(function () {
            Route::middleware(['adminRoute'])->prefix('calculator')->group(function () {
                Route::get('/', function () {
                    return view('pages.report.productCal.index');
                });
                Route::get('getCalProducts', [CalProductsController::class, 'getCalProducts']);
                Route::get('getCalProductParts/{id}&{value}', [CalProductsController::class, 'getCalProductParts']);
            });

            Route::prefix('dashBoard')->group(function () {
                Route::get('/', function () {
                    return view('pages.report.dashBoard.index');
                });
                Route::get('getDataHistory/{id}', [DashBoardController::class, 'getDataHistory']);
                Route::get('getPartsByBranch/{id}', [DashBoardController::class, 'getPartsByBranch']);
                Route::get('getDashBoard', [DashBoardController::class, 'getDashBoard']);

            });
            Route::prefix('pointerLocation')->group(function () {
                Route::get('/', function () {
                    return view('pages.report.report.pointerLocation.index');
                });
                Route::get('getAllDetail', [LocationProductDetailController::class, 'getAllDetail']);
                Route::get('getFilter', [LocationProductDetailController::class, 'getFilter']);

            });
        });

        //Session branch
        Route::middleware(['hasBranchSession', 'hasCustomerSession', 'hasDealerSession'])->get('/selectBranch', function () {
            return view('pages.selectBranch.index');
        });
        Route::post('getSessionBranch', [BranchSessionController::class, 'getSessionBranch'])->name('getSessionBranch');
        Route::get('removeSessionBranch', [BranchSessionController::class, 'removeSessionBranch'])->name('removeSessionBranch');
        //end Session branch

        //Session customer
        Route::middleware(['hasBranchSession', 'hasCustomerSession', 'hasDealerSession'])->get('/selectCustomer', function () {
            return view('pages.selectCustomer.index');
        });
        Route::post('getSessionCustomer', [CustomerSessionController::class, 'getSessionCustomer'])->name('getSessionCustomer');
        Route::get('removeSessionCustomer', [CustomerSessionController::class, 'removeSessionCustomer'])->name('removeSessionCustomer');
        //end Session customer

        //Session dealer
        Route::middleware(['hasBranchSession', 'hasCustomerSession', 'hasDealerSession'])->get('/selectDealer', function () {
            return view('pages.selectDealer.index');
        });
        Route::post('getSessionDealer', [DealerSessionController::class, 'getSessionDealer'])->name('getSessionDealer');
        Route::get('removeSessionDealer', [DealerSessionController::class, 'removeSessionDealer'])->name('removeSessionDealer');
    });
});


Route::get('/index', function () {
    return view('original');
});
