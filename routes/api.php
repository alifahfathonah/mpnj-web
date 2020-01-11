<?php

// use App\Http\Resources\DetailProdukResource;
use Illuminate\Http\Request;
<<<<<<< HEAD
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
=======
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
>>>>>>> d30a528be2c70dfccc9acc5f45664fca90be5577

Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});
