<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::resource('products', 'ProductController');

Route::get('/', 'Controller@welcome');

/* Product Controller */

Route::get('/home/{user}', 'ProductController@index')->name('home');

Route::get('/product/prodList/{user}', 'ProductController@prodList');

Route::get('/product/{product}', 'ProductController@show')->name('show');

Route::get('/create', 'ProductController@create')->name('create');

Route::post('/store', 'ProductController@store')->name('store');

Route::get('/product/{product}/edit', 'ProductController@edit')->name('edit');

Route::patch('/product/{product}', 'ProductController@update')->name('update');



/* END Product Controller */

/* Cart Controller */

Route::get('/add-to-cart/{id}', 'CartController@AddToCart');

Route::get('/reduced-by-one/{id}', 'CartController@ReducedByOne');

Route::get('/remove-item/{id}', 'CartController@RemoveItem');

/* END Cart Controller */

/* Order Controller */

Route::get('/order/orderList/{user}', 'OrderController@orderList');

Route::get('/order', 'OrderController@store_order')->name('store_order');

/* END Order Controller */