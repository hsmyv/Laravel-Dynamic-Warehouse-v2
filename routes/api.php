<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;

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

Route::delete('warehouse/delete', [WarehouseController::class, 'destroy']);
Route::post('warehouses/update/{id}', 'WarehouseController@update')->name('warehouse.edit');

Route::delete('product/delete', [ProductController::class, 'destroy'])->name('products.destroy');

Route::resource('product',  ProductController::class);
Route::resource('category', CategoryController::class);
