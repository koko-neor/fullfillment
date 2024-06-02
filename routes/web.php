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
use App\Http\Controllers\HomeController;

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

    Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
});

Route::post('/orders/{order}/add-product', [OrderController::class, 'addProductToOrderAjax'])->name('orders.addProductToOrderAjax');
Route::post('/products/create', [OrderController::class, 'storeProductAjax'])->name('orders.storeProductAjax');
Route::delete('/orders/{order}/remove-product', [OrderController::class, 'removeProductFromOrderAjax'])->name('orders.removeProductFromOrderAjax');
Route::get('/products/search', [OrderController::class, 'searchProductsAjax'])->name('orders.searchProductsAjax');

Route::post('/order-tasks/store', [OrderTaskController::class, 'store'])->name('order-tasks.store');

Auth::routes(['register' => false, 'reset' => false]);
