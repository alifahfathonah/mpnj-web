<?php

use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource as ProdukResource;
use App\Http\Resources\KategoriResource as KategoriResource;
use App\Http\Resources\DetailProdukResource as DetailProdukResource;
use App\Models\Produk;
use App\Models\Kategori_Produk;


//Refactor routing api
Route::group(['namespace' => 'Api'], function () {

    //produk
    Route::group(['prefix' => 'produk'], function () {
        Route::get('/', 'ApiProdukController@index');
        Route::get('/{id_produk}', 'ApiProdukController@getDetail');
        Route::post('/', 'ApiProdukController@create');
    });
    //konsumen
    Route::group(['prefix' => 'konsumen'], function () {
        Route::post('/', 'ApiRegisterKonsumenController@create');
        Route::put('/{id_konsumen}', 'ApiRegisterKonsumenController@update');
        Route::get('/profil/{id_konsumen}', 'ApiKonsumenController@profile');
        Route::post('/alamat', 'ApiKonsumenController@simpan_alamat');
        Route::get('/tampil/alamat/{id_alamat}', 'ApiKonsumenController@show_alamat');
        Route::put('/edit/alamat/{id_alamat}', 'ApiKonsumenController@update_alamat');
        Route::post('/edit/alamat/utama/{id_alamat}', 'ApiKonsumenController@update_alamat_utama');
        Route::delete('/hapus/alamat/{id_alamat}', 'ApiKonsumenController@hapus_alamat');
        Route::put('/hapus/{id_konsumen}', 'ApiKonsumenController@hapus_akun');
        Route::put('/aktif/{id_konsumen}', 'ApiKonsumenController@aktif_kembali');
        Route::post('/upload', 'ApiRegisterKonsumenController@upload');
    });
});

// PRODUK
// Route::get('/produk', 'Api\ApiProdukController@index');
// Route::get('/produk/{id_produk}', 'Api\ApiProdukController@getDetail');
// Route::post('/produk', 'Api\ApiProdukController@create');

// KONSUMEN
Route::post('/konsumen', 'Api\ApiRegisterKonsumenController@create');
Route::put('/konsumen/{id_konsumen}', 'Api\ApiRegisterKonsumenController@update');
Route::get('/profil/{id_konsumen}', 'Api\ApiKonsumenController@profile');

Route::post('/konsumen/alamat', 'Api\ApiKonsumenController@simpan_alamat');
Route::get('/konsumen/tampil/alamat/{id_alamat}', 'Api\ApiKonsumenController@show_alamat');
Route::put('/konsumen/edit/alamat/{id_alamat}', 'Api\ApiKonsumenController@update_alamat');
Route::post('/konsumen/edit/alamat/utama/{id_alamat}', 'Api\ApiKonsumenController@update_alamat_utama');
Route::delete('/konsumen/hapus/alamat/{id_alamat}', 'Api\ApiKonsumenController@hapus_alamat');
Route::put('/konsumen/hapus/{id_konsumen}', 'Api\ApiKonsumenController@hapus_akun');
Route::put('/konsumen/aktif/{id_konsumen}', 'Api\ApiKonsumenController@aktif_kembali');
Route::post('/konsumen/upload', 'Api\ApiRegisterKonsumenController@upload');


Route::get('/email/{email}', 'Api\ApiKonsumenController@cek_email');
Route::post('/login', 'Api\Auth\ApiLoginController@login');
Route::post('/keluar', 'Api\Auth\ApiLoginController@keluar');
Route::put('/password/{id_konsumen}', 'Api\ApiKonsumenController@ganti_password');

// PELAPAK
Route::get('/pelapak', 'Api\ApiPelapakController@index');
Route::post('/pelapak', 'Api\ApiPelapakController@create');
Route::delete('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@delete');
Route::get('/pelapak/{id_pelapak}', 'Api\ApiPelapakController@getDetail');
Route::post('/pelapak/upload', 'Api\ApiPelapakController@upload');

//keranjang
Route::get('/keranjang', 'Api\ApiKeranjangController@index'); //http://localhost:8000/api/keranjang?role=konsumen&id=1
Route::post('/keranjang', 'Api\ApiKeranjangController@simpan');
Route::delete('/keranjang/{id_keranjang}', 'Api\ApiKeranjangController@hapus');
Route::put('/keranjang/ganti_jumlah/{id_keranjang}', 'Api\ApiKeranjangController@gantiJumlah');
Route::put('/keranjang/{id}/go_checkout', 'Api\ApiKeranjangController@keCheckOut');
Route::post('/keranjang/cek_harga', 'Api\ApiKeranjangController@cekHarga');

//transaksi
Route::get('/transaksi', 'Api\ApiTransaksiController@index');
Route::post('/transaksi/simpan', 'Api\ApiTransaksiController@simpan');

//kategori
Route::get('/kategori', 'Api\ApiKategoriController@index');
Route::get('/kategori/{id}', 'Api\ApiKategoriController@produk');

//konfirmasi
Route::get('/konfirmasi/{kode_transaksi}', 'Api\ApiKonfirmasiController@tampilData');
Route::post('/konfirmasi/simpan', 'Api\ApiKonfirmasiController@simpan');

//rajaongkir gateway
Route::post('/ongkir', 'Api\RajaOngkirGateway@ongkir');
Route::get('/gateway/provinsi', 'Api\RajaOngkirGateway@provinsi');
Route::get('/gateway/kota', 'Api\RajaOngkirGateway@kota');
Route::get('/gateway/kotaId', 'Api\RajaOngkirGateway@kotaId');
Route::get('/gateway/kecamatan', 'Api\RajaOngkirGateway@kecamatan');
Route::get('/gateway/kecamatanId', 'Api\RajaOngkirGateway@kecamatanId');
Route::post('/gateway/tracking', 'Api\RajaOngkirGateway@tracking_check');
