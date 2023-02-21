<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;

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
Route::redirect('/', '/products');



Route::get('/products', function () {
    return view('product', [
        'products' => Product::latest()->simplePaginate(10),
        'categories' => Category::All(),
        'warehouses' => Warehouse::all()
    ]);
});
Route::get('/category', function () {
    return view('category', [
        'categories' => Category::All()
    ]);
});
Route::get('/warehouses', function(){
    return view('warehouse', [ 'warehouses' => Warehouse::all()]);
});

