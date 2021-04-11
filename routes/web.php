<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', 'App\Http\Controllers\ProductController@productDetails')->name('product.details');
Route::get('products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('cart', [HomeController::class, 'cart'])->name('cart');
Route::get('thank-you', [HomeController::class, 'thankYou'])->name('thankYou');

Route::group([
    'prefix' => 'order',
    'as' => 'order.',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::post('store-order', 'OrderController@store')->name('store');
    Route::post('add-cart/{product}', 'OrderController@addToCart')->name('addtocart');
    Route::post('update-cart/{product}', 'OrderController@updateCart')->name('updateCart');
    Route::post('remove-cart/{product}', 'OrderController@removeItemFromCart')->name('removeFromCart');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('order', 'OrderController');
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
});

Route::group([
    'prefix' => 'customer',
    'as' => 'customer.',
    'namespace' => 'App\Http\Controllers\Customer',
    'middleware' => ['auth', 'customer']
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('order', 'OrdersController');
});


Auth::routes();
