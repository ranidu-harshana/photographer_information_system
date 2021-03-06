<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InteringPaymentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SessionController;
use App\Models\Customer;
use App\Models\FunctionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    Route::put('/postpone/{customer}', [CustomerController::class, 'postpone'])->name('postpone');
    Route::put('/add/date/{id}', [CustomerController::class, 'add_date'])->name('add_date');
    Route::put('/add/location/{id}', [CustomerController::class, 'add_location'])->name('add_location');

    Route::post('set_tab0_session', [SessionController::class, 'set_tab0_session']);
    Route::post('set_tab1_session', [SessionController::class, 'set_tab1_session']);
    Route::post('set_tab2_session', [SessionController::class, 'set_tab2_session']);
    Route::post('set_tab3_session', [SessionController::class, 'set_tab3_session']);
    Route::post('set_tab4_session', [SessionController::class, 'set_tab4_session']);
    Route::post('set_tab5_session', [SessionController::class, 'set_tab5_session']);

    Route::resource('note', NoteController::class);
    Route::put('/note/{note}/mark_as_read', [NoteController::class, 'mark_as_read'])->name('note.mark_as_read');

    Route::post('/get_all_func_dates', [CustomerController::class, 'get_all_func_dates'])->name('get_all_func_dates');
    Route::post('/get_functions_of_day', [CustomerController::class, 'get_functions_of_day'])->name('get_functions_of_day');
    Route::put('/edit/bill/{customer}', [CustomerController::class, 'edit_bill'])->name('edit_bill');

    Route::post('/detach/item/package/customer', [CustomerController::class, 'detach_package_item_customer'])->name('detach_package_item_customer');
    Route::delete('/attach/item/package/customer', [CustomerController::class, 'attach_package_item_customer'])->name('attach_package_item_customer');

    Route::put('/update_customer_items/{item}', [CustomerController::class, 'update_customer_items'])->name('update_customer_items');
    Route::put('/update_customer_packages/{package}', [CustomerController::class, 'update_customer_packages'])->name('update_customer_packages');
    Route::put('mark_as_delivered/{item}', [CustomerController::class, 'mark_as_delivered'])->name('mark_as_delivered');

    Route::put('customer_package_item_mark_as_delivered/{item}', [CustomerController::class, 'customer_package_item_mark_as_delivered'])->name('customer_package_item_mark_as_delivered');
    Route::put('/update_customer_package_items/{item}', [CustomerController::class, 'update_customer_package_items'])->name('update_customer_package_items');
    
    Route::resource('intering_payment', InteringPaymentController::class);

    Route::post('/invoice/{customer}', [CustomerController::class, 'invoice_pdf'])->name('invoice');
    
    Route::get('test/{customer}', function($customer_id) {
        
        
    });
});

