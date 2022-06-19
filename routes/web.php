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

Route::get('/', function () {
    return view('home');
});

Route::post('simpan_Product','ProductController@simpan');
Route::get('ambil_semua_product','ProductController@ambil');
Route::get('edit_product/{id}','ProductController@ambilDataUpdate');
Route::put('update_product','ProductController@updateProduct');
Route::get('show_product/{id}','ProductController@showDataProduct');
Route::get('cari_status','ProductController@cariStatus');


Route::delete('hapus_product/{id}','ProductController@hapusProduct'); 
