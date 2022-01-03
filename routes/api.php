<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StoreCategoryController;
use App\Http\Controllers\Api\BuyerController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/signup', [LoginController::class, 'register']);
    Route::post('/signin', [LoginController::class, 'login']);
    Route::get('/user', [LoginController::class, 'user']);
    Route::post('/token-refresh', [LoginController::class, 'refresh']);
});
    Route::group(['prefix'=>'admin'],function(){
        Route::post('category/store',[StoreCategoryController::class,'store'])->name('category.store');
        Route::get('category/list',[StoreCategoryController::class,'index'])->name('category');
        Route::post('category/update/',[StoreCategoryController::class,'update'])->name('category.update');
        Route::get('category/delete/{id}',[StoreCategoryController::class,'destroy'])->name('category.delete');
    });

    Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('category/list',[CategoryController::class,'index'])->name('category');
    Route::post('category/update/',[CategoryController::class,'update'])->name('category.update');
    Route::get('category/delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');

    Route::group(['prefix'=>'store/'],function(){
        Route::post('store',[StoreController::class,'store'])->name('business.store');
        Route::get('list',[StoreController::class,'index'])->name('store.list');
        Route::get('delete/{id}',[StoreController::class,'destroy'])->name('store.delete');
        Route::post('update',[StoreController::class,'update'])->name('store.update');
    });

    Route::group(['prefix'=>'product/'],function(){
        Route::get('list',[ProductController::class,'index'])->name('product.list');
        Route::post('store',[ProductController::class,'store'])->name('product.store');
        Route::post('update',[ProductController::class,'update'])->name('product.update');
        Route::post('delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
        Route::get('view/{id}',[ProductController::class,'show'])->name('product.view');
    });

    Route::group(['prefix'=>'buyer'],function(){
        Route::get('/latest/store',[BuyerController::class,'latest'])->name('latest.store');
        Route::post('/profile/update',[BuyerController::class,'profileUpdate'])->name('profile.update');
        Route::get('/store/detail',[BuyerController::class,'storeDetail'])->name('store.detail');
    });
    


