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


// PRODUK
Route::get('/kategori', function () {
    return KategoriResource::collection(kategori_Produk::all());
});
Route::get('/produk', 'Api\ApiProdukController@index');
Route::get('/produk/{id_produk}', 'Api\ApiProdukController@getDetail');
Route::post('/produk', 'Api\ApiProdukController@create');

// KONSUMEN
Route::post('/konsumen', 'Api\ApiRegisterKonsumenController@create');
Route::put('/konsumen/{id_konsumen}', 'Api\ApiRegisterKonsumenController@update');
Route::get('/profil/{id_konsumen}', 'Api\ApiKonsumenController@profile');

Route::post('/konsumen/alamat', 'Api\ApiKonsumenController@simpan_alamat');
Route::get('/konsumen/tampil/alamat/{id_alamat}', 'Api\ApiKonsumenController@show_alamat');
Route::put('/konsumen/edit/alamat/{id_alamat}', 'Api\ApiKonsumenController@update_alamat');
Route::post('/konsumen/edit/alamat/utama/{id_alamat}', 'Api\ApiKonsumenController@update_alamat_utama');
Route::delete('/konsumen/hapus/alamat/{id_alamat}', 'Api\ApiKonsumenController@hapus_alamat');
Route::delete('/konsumen/{id_konsumen}', 'Api\ApiKonsumenController@hapus_akun');

Route::get('/email/{email}', 'Api\ApiKonsumenController@cek_email');
Route::post('/login', 'Api\Auth\ApiLoginController@login');
Route::post('/keluar', 'Api\Auth\ApiLoginController@keluar');
Route::put('/password/{id_konsumen}', 'Api\ApiKonsumenController@ganti_password');

// PELAPAK
Route::get('/pelapak', 'Api\ApiPelapakController@index');
Route::post('/pelapak', 'Api\ApiPelapakController@create');
Route::delete('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@delete');
Route::get('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@getDetail');

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
Route::post('/ongkir', 'Api\RajaOngkirGateway@ongkir');
Route::get('/gateway/provinsi', 'Api\RajaOngkirGateway@provinsi');
Route::get('/gateway/kota', 'Api\RajaOngkirGateway@kota');
Route::get('/gateway/kotaId', 'Api\RajaOngkirGateway@kotaId');
