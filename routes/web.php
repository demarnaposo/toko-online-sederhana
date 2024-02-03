<?php

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

Route::get('/', 'UtamaController@index');
Route::post('/pushData', 'UtamaController@store');
Route::get('/login', 'LoginController@index');
Route::post('/register', 'LoginController@register');
Route::post('/masuk', 'LoginController@masuk');
Route::get('/logout', 'LoginController@logout');
Route::post('/keranjang', 'OrderController@order');
Route::get('/keranjangview', 'OrderController@keranjang');
Route::get('/checkout', 'OrderController@checkout');
Route::get('/checkoutview', 'OrderController@list_checkout');
Route::get('/konfirmasiview', 'OrderController@konfirmasi');
Route::post('/konfirm', 'OrderController@konfirm_simpan');
