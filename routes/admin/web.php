<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;

/******************************** Login ************************************/

Route::get('login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('login', [AuthController::class, 'login'])->name('login');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    /******************************** Admin ************************************/

    Route::get('', [AdminController::class, 'index'])->name('index');

    /******************************** Logout ************************************/
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    /******************************** users ************************************/

    Route::resource('users', UsersController::class);

    /******************************** Categories *******************************/

    Route::resource('category', CategoryController::class);

    /******************************** Products *********************************/

    Route::Resource('product', ProductController::class);

    /******************************** Clients *********************************/
    Route::Resource('client', ClientController::class);

    /******************************** Orders *********************************/
    // Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    //     Route::get('', [OrderController::class, 'index'])->name('index');
    //     Route::get('create/{client}', [OrderController::class, 'create'])->name('create');
    //     Route::post('store/{client}', [OrderController::class, 'store'])->name('store');
    //     Route::get('edit/{client}/{order}', [OrderController::class, 'edit'])->name('edit');
    //     Route::put('update/{client}/{order}', [OrderController::class, 'update'])->name('update');
    //     Route::delete('destroy/{order}', [OrderController::class, 'destroy'])->name('destroy');
    //     Route::get('/{order}/products', [OrderController::class, 'products'])->name('products');
    // });
    Route::Resource('order.client', OrderController::class);
});
