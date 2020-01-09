<?php

use Illuminate\Http\Request;
use App\Http\Resources\PelapakResource as PelapakResource;
use App\User;
use App\Models\Pelapak;
use App\Models\Kategori_Produk;

Route::get('produk/{id}', 'Api\ProdukController@DetailProduk');
Route::get('produk', 'Api\ProdukController@SemuaProduk');

// Route::get('produk/{id}', function($id) {
//     return Produk::find($id);
// });

Route::get('/pelapak', function () {
    return PelapakResource::collection(Pelapak::all());
});

Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});
