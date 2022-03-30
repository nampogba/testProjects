<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function (){
    Route::get('product/add', 'backend\AdminProductController@addProduct')->name('addProduct');
    Route::get('product/list', 'backend\AdminProductController@listProduct')->name('listProduct');
    Route::post('product/store', 'backend\AdminProductController@storeProduct')->name('storeProduct');
    Route::get('product/edit/{id}', 'backend\AdminProductController@editProduct')->name('editProduct');
    Route::post('product/update/{id}', 'backend\AdminProductController@updateProduct')->name('updateProduct');
});


