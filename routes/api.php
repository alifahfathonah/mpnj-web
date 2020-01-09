<?php

use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource as ProdukResource;
use App\Http\Resources\KategoriResource as KategoriResource;
use App\User;
use App\Models\Produk;
use App\Models\Kategori_Produk;

Route::get('produk/{id}', 'Api\ProdukController@DetailProduk');
Route::get('produk', 'Api\ProdukController@SemuaProduk');

// Route::get('produk/{id}', function($id) {
//     return Produk::find($id);
// });

// Route::get('/produk/{id}', function ($id) {
//     return ProdukResource::collection(Produk::find($id));
// });

Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});
