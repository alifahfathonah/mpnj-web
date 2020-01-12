<?php

// use App\Http\Resources\DetailProdukResource;
use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource as ProdukResource;
use App\Http\Resources\KategoriResource as KategoriResource;
use App\Http\Resources\DetailProdukResource as DetailProdukResource;
use App\Models\Produk;
use App\Models\Kategori_Produk;

//getProdukWithRepository
Route::get('/produk', 'Api\ProdukController@index');

//getOneProdukWithRepository
Route::get('/produk/{id_produk}', 'Api\ProdukController@getDetail');

//getAllProdukWithResource
// Route::get('/produk', function () {
//     return ProdukResource::collection(Produk::all());
// });

Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});

//api konsumen
Route::post('/konsumen', 'Api\RegisterKonsumenController@create');
Route::put('/konsumen/{id_konsumen}', 'Api\RegisterKonsumenController@update');
