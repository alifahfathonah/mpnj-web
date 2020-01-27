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
Route::post('/login','Api\Auth\ApiLoginController@login');
Route::post('/konsumen', 'Api\ApiRegisterKonsumenController@create');
Route::put('/konsumen/{id_konsumen}', 'Api\ApiRegisterKonsumenController@update');

Route::get('/pelapak', 'Api\ApiPelapakController@index');
Route::post('/pelapak', 'Api\ApiPelapakController@create');
Route::delete('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@delete');

Route::get('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@getDetail');


Route::post('/produk', 'Api\ApiProdukController@create');

Route::post('/ongkir', 'Api\RajaOngkirGateway@ongkir');

//keranjang
Route::get('/keranjang', 'Api\ApiKeranjangController@index');
Route::post('/keranjang', 'Api\ApiKeranjangController@simpan');
Route::delete('/keranjang/{id_keranjang}', 'Api\ApiKeranjangController@hapus');
Route::put('/keranjang/ganti_jumlah/{id_keranjang}', 'Api\ApiKeranjangController@gantiJumlah');
Route::post('/keranjang/cek_harga', 'Api\ApiKeranjangController@cekHarga');
