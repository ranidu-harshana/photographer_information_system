<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PackageController;
use App\Models\FunctionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::resource('customer', CustomerController::class);
    Route::resource('item', ItemController::class);
    Route::resource('function/type', FunctionType::class);
    Route::resource('package', PackageController::class);

    Route::get('/get/item/{function_id}', [ItemController::class, 'get_items_of_function'])->name('get_items_of_function');
});
