<?php

use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource as ProdukResource;
use App\Http\Resources\KategoriResource as KategoriResource;
use App\User;
use App\Models\Produk;
use App\Models\Kategori_Produk;

// Route::get('produk', 'Api\ProdukController@index');

Route::get('/produk', function () {
    return ProdukResource::collection(Produk::all());
});

Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});
