<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderFileController;
use App\Http\Controllers\OrderTaskController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLabelController;
use App\Http\Controllers\ProductStorageController;
use App\Http\Controllers\ReturnOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\StorageBlockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/organizations', OrganizationController::class);
    Route::resource('admin/orders', OrderController::class);
    Route::resource('admin/order-details', OrderDetailController::class);
    Route::resource('admin/order-files', OrderFileController::class);
    Route::resource('admin/order-tasks', OrderTaskController::class);
    Route::resource('admin/products', ProductController::class);
    Route::resource('admin/product-labels', ProductLabelController::class);
    Route::resource('admin/product-storages', ProductStorageController::class);
    Route::resource('admin/return-orders', ReturnOrderController::class);
    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/stock-entries', StockEntryController::class);
    Route::resource('admin/storage-blocks', StorageBlockController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/warehouses', WarehouseController::class);
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
