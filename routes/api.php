<?php

// use App\Http\Resources\DetailProdukResource;
use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource as ProdukResource;
use App\Http\Resources\KategoriResource as KategoriResource;
use App\Http\Resources\DetailProdukResource as DetailProdukResource;
use App\Models\Produk;
use App\Models\Kategori_Produk;

//api produk dengan resource
Route::get('/produk', 'Api\ApiProdukController@index');
Route::get('/produk/{id_produk}', 'Api\ApiProdukController@getDetail');

//getAllProdukWithResource
// Route::get('/produk', function () {
//     return ProdukResource::collection(Produk::all());
// });

Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});

Route::post('/konsumen', 'Api\ApiRegisterKonsumenController@create');
Route::put('/konsumen/{id_konsumen}', 'Api\ApiRegisterKonsumenController@update');

Route::get('/pelapak', 'Api\ApiPelapakController@index');

Route::get('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@getDetail');

Route::post('/produk','Api\ApiProdukController@create');