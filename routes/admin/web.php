<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\client\OrderClientController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('client.order', OrderClientController::class);

    /******************************** Orders *********************************/


});

