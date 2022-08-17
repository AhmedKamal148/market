<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;




/***************************************************************************/
/******************************** Login ************************************/

Route::get('login' ,         [AuthController::class,'loginPage'])->name('loginPage');
Route::post('login' ,        [AuthController::class,'login'])->name('login');

/***************************************************************************/

Route::group(['prefix' => 'admin' ,  'as' =>'admin.' ,'middleware' => 'auth'],function()
{
    Route::get('' ,[AdminController::class,'index'])->name('index');

    /***************************************************************************/
    /******************************** Logout ************************************/
    Route::get('logout' ,        [AuthController::class,'logout'])->name('logout');

    /***************************************************************************/
    /******************************** users ************************************/
    Route::group(['prefix' => 'users' , 'as' => 'users.'], function()
    {
        Route::get('' ,                                  [UsersController::class,'index'])->name('index');
        Route::get('create',                             [UsersController::class,'create'])->name('create');
        Route::post('store',                             [UsersController::class,'store'])->name('store');
        Route::get('edit/{user_id}' ,                    [UsersController::class,'edit'])->name('edit');
        Route::put('update',                             [UsersController::class ,'update']) ->name('update');
        Route::delete('delete' ,                         [UsersController::class,'delete'])->name('delete');
    });

    /***************************************************************************/
    /******************************** Categories ************************************/
    Route::group(['prefix' => 'category' , 'as' => 'category.'], function()
    {
        Route::get('' ,                                  [CategoryController::class,'index'])->name('index');
        Route::get('create',                             [CategoryController::class,'create'])->name('create');
        Route::post('store',                             [CategoryController::class,'store'])->name('store');
        Route::get('edit/{category_id}' ,                [CategoryController::class,'edit'])->name('edit');
        Route::put('update',                             [CategoryController::class ,'update'])->name('update');
        Route::delete('delete' ,                         [CategoryController::class,'delete'])->name('delete');
    });
    /***************************************************************************/
    /***************************************************************************/
    /******************************** Categories ************************************/
    Route::group(['prefix' => 'product' , 'as' => 'product.'], function()
    {
        Route::get('' ,                                  [ProductController::class,'index'])->name('index');
        Route::get('create',                             [ProductController::class,'create'])->name('create');
        Route::post('store',                             [ProductController::class,'store'])->name('store');
        Route::get('edit/{product_id}' ,                 [ProductController::class,'edit'])->name('edit');
        Route::put('update',                             [ProductController::class ,'update'])->name('update');
        Route::delete('delete' ,                         [ProductController::class,'delete'])->name('delete');
    });
    /***************************************************************************/

});

