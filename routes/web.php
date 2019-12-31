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
    return view('welcome');
});

//produk
Route::get('administrator/produk', 'ProdukController@index');
Route::get('administrator/produk/tambah', 'ProdukController@tambah');
Route::post('administrator/produk/simpan', 'ProdukController@simpan');
Route::get('administrator/produk/edit/{id}', 'ProdukController@edit');
Route::post('administrator/produk/ubah/{id}', 'ProdukController@ubah');
Route::get('administrator/produk/hapus/{id}', 'ProdukController@hapus');

//rekening
Route::get('administrator/rekening', 'RekeningPelapakController@index');
Route::get('administrator/rekening/tambah', 'RekeningPelapakController@tambah');
Route::post('administrator/rekening/simpan', 'RekeningPelapakController@simpan');
