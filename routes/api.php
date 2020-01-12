<?php

// use App\Http\Resources\DetailProdukResource;
use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource as ProdukResource;
use App\Http\Resources\KategoriResource as KategoriResource;
use App\Http\Resources\DetailProdukResource as DetailProdukResource;
use App\Models\Produk;
use App\Models\Kategori_Produk;

//api produk dengan resource
Route::get('/produk', 'Api\ProdukController@index');
Route::get('/produk/{id_produk}', 'Api\ProdukController@getDetail');

//getAllProdukWithResource
// Route::get('/produk', function () {
//     return ProdukResource::collection(Produk::all());
// });

Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});

Route::post('/konsumen', 'Api\RegisterKonsumenController@create');
Route::put('/konsumen/{id_konsumen}', 'Api\RegisterKonsumenController@update');

Route::get('/pelapak', 'Api\ApiPelapakController@index');

<<<<<<< HEAD
Route::get('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@getDetail');
=======
Route::get('/pelapak/{id_pelapak}', 'Api\PelapakController@getDetail');

>>>>>>> 05293f6b974a3dba38dedb7117772e834024bcbc
