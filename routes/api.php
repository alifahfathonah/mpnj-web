<?php

// use App\Http\Resources\DetailProdukResource;
use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource as ProdukResource;
use App\Http\Resources\KategoriResource as KategoriResource;
use App\Http\Resources\DetailProdukResource as DetailProdukResource;
use App\Models\Produk;
use App\Models\Kategori_Produk;
// use Illuminate\Routing\Route;
// use Illuminate\Support\Facades\Route;

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
Route::get('/profil/{id_konsumen}', 'Api\ApiKonsumenController@profile');
Route::get('/email/{email}', 'Api\ApiKonsumenController@cek_email');
Route::post('/login','Api\Auth\ApiLoginController@login');
Route::post('/keluar', 'Api\Auth\ApiLoginController@keluar');
Route::put('/password/{id_konsumen}', 'Api\ApiKonsumenController@lupa_password');

// Route::get('keluar', 'Api\Auth\ApiLoginController@keluar')->middleware('auth:konsumen');

Route::post('/konsumen', 'Api\ApiRegisterKonsumenController@create');
Route::put('/konsumen/{id_konsumen}', 'Api\ApiRegisterKonsumenController@update');

Route::get('/pelapak', 'Api\ApiPelapakController@index');
Route::post('/pelapak', 'Api\ApiPelapakController@create');
Route::delete('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@delete');

Route::get('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@getDetail');


Route::post('/produk', 'Api\ApiProdukController@create');

Route::post('/ongkir', 'Api\RajaOngkirGateway@ongkir');

//keranjang
Route::get('/keranjang', 'Api\ApiKeranjangController@index'); //http://localhost:8000/api/keranjang?role=konsumen&id=1
Route::post('/keranjang', 'Api\ApiKeranjangController@simpan');
Route::delete('/keranjang/{id_keranjang}', 'Api\ApiKeranjangController@hapus');
Route::put('/keranjang/ganti_jumlah/{id_keranjang}', 'Api\ApiKeranjangController@gantiJumlah');
Route::post('/keranjang/cek_harga', 'Api\ApiKeranjangController@cekHarga');

//transaksi
Route::get('/transaksi', 'Api\ApiTransaksiController@index');
Route::post('/transaksi/simpan', 'Api\ApiTransaksiController@simpan');


//konfirmasi
Route::get('/konfirmasi/{kode_transaksi}', 'Api\ApiKonfirmasiController@tampilData');
Route::post('/konfirmasi/simpan', 'Api\ApiKonfirmasiController@simpan');

//rajaongkir gateway
Route::get('/gateway/provinsi', 'Api\RajaOngkirGateway@provinsi');
Route::get('/gateway/kota', 'Api\RajaOngkirGateway@kota');
Route::get('/gateway/kotaId', 'Api\RajaOngkirGateway@kotaId');