<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SessionController;
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

    Route::resource('customer', CustomerController::class);
    Route::resource('item', ItemController::class);
    Route::resource('function/type', FunctionType::class);
    Route::resource('package', PackageController::class);
    Route::get('/get_package_items/{package}', [PackageController::class, 'get_package_items'])->name('get_package_items');

    Route::get('/get/item/{function_id}', [ItemController::class, 'get_items_of_function'])->name('get_items_of_function');
    Route::delete('/detach/item/{package_id}', [PackageController::class, 'item_detach'])->name('item.detach');
    Route::post('/attach/item/{package_id}', [PackageController::class, 'item_attach'])->name('item.attach');

    Route::post('/customer/attach/item/{customer_id}', [CustomerController::class, 'item_attach'])->name('customer.item.attach');
    Route::delete('/customer/detach/item/{customer_id}', [CustomerController::class, 'item_detach'])->name('customer.item.detach');
    Route::post('/customer/attach/package/{customer_id}', [CustomerController::class, 'package_attach'])->name('customer.package.attach');
    Route::delete('/customer/detach/package/{customer_id}', [CustomerController::class, 'package_detach'])->name('customer.package.detach');

    Route::post('set_tab0_session', [SessionController::class, 'set_tab0_session']);
    Route::post('set_tab1_session', [SessionController::class, 'set_tab1_session']);
    Route::post('set_tab2_session', [SessionController::class, 'set_tab2_session']);
    Route::post('set_tab3_session', [SessionController::class, 'set_tab3_session']);
    Route::post('set_tab4_session', [SessionController::class, 'set_tab4_session']);
    Route::post('set_tab5_session', [SessionController::class, 'set_tab5_session']);

    Route::resource('note', NoteController::class);
    Route::put('/note/{note}/mark_as_read', [NoteController::class, 'mark_as_read'])->name('note.mark_as_read');
});

