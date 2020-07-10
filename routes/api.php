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
        Route::get('/diskon/', 'ApiProdukController@diskonProduk');
        Route::get('/laris/', 'ApiProdukController@larisProduk');
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
        Route::put('/edit/alamat/utama/{id_user}', 'ApiKonsumenController@update_alamat_utama');
        Route::delete('/hapus/alamat/{id_alamat}', 'ApiKonsumenController@hapus_alamat');
        Route::put('/hapus/{id_konsumen}', 'ApiKonsumenController@hapus_akun');
        Route::put('/aktif/{id_konsumen}', 'ApiKonsumenController@aktif_kembali');
        Route::post('/upload', 'ApiRegisterKonsumenController@upload');
    });

    //pelapak
    Route::group(['prefix' => 'pelapak'], function () {
        Route::get('/', 'ApiPelapakController@index');
        Route::post('/', 'ApiPelapakController@create');
        Route::delete('/{id_pelapak}', 'ApiPelapakController@delete');
        Route::get('/{id_pelapak}', 'ApiPelapakController@getDetail');
        Route::post('/upload', 'ApiPelapakController@upload');
        Route::get('/find/{username}', 'ApiPelapakController@findPelapak');
    });

    //keranjang
    Route::group(['prefix' => 'keranjang'], function () {
        Route::get('/', 'ApiKeranjangController@index'); //http://localhost:8000/api/keranjang?id=1
        Route::post('/', 'ApiKeranjangController@simpan');
        Route::delete('/{id_keranjang}', 'ApiKeranjangController@hapus');
        Route::put('/ganti_jumlah/{id_keranjang}', 'ApiKeranjangController@gantiJumlah');
        Route::put('/{id}/go_checkout', 'ApiKeranjangController@keCheckOut');
        Route::post('/cek_harga', 'ApiKeranjangController@cekHarga');
    });

    //transaksi
    Route::group(['prefix' => 'transaksi'], function () {
        Route::post('/', 'ApiTransaksiController@index');
        Route::get('/tgl/{kode_transaksi}', 'ApiTransaksiController@transaksiDate');
        Route::post('/simpan', 'ApiTransaksiController@simpan');
        Route::put('/batal', 'ApiTransaksiController@batal');
        Route::post('/simpanKurir', 'ApiTransaksiController@simpanKurir');
        Route::post('/batal_transaksi', 'ApiTransaksiController@batalTrx');
    });

    //kategori
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', 'ApiKategoriController@index');
        Route::get('/{id}', 'ApiKategoriController@produk');
    });

    //konfimasi
    Route::group(['prefix' => 'konfirmasi'], function () {
        Route::get('/{kode_transaksi}', 'ApiKonfirmasiController@tampilData');
        Route::post('/simpan', 'ApiKonfirmasiController@simpan');
    });

    //bank
    Route::group(['prefix' => 'bank'], function () {
        Route::get('/', 'ApiBankController@index');
        Route::get('/rekening/{id_bank}', 'ApiBankController@rekAdmin');
    });

    //pesanan
    Route::group(['prefix' => 'pesanan'], function () {
        Route::get('/', 'ApiPesananController@index');
        Route::get('/{id_detail}', 'ApiPesananController@getDetail');
        Route::post('/terima', 'ApiPesananController@terima');
    });

    //review
    Route::group(['prefix' => 'review'], function () {
        Route::get('/{id_produk}', 'ApiReviewController@getReview');
        Route::post('/simpan', 'ApiReviewController@simpan');
        Route::post('/edit/{id_user}/{id_produk}', 'ApiReviewController@update');
    });

    //wishlist
    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('/tampil/{id_user}', 'ApiWishlistController@index');
        Route::post('/simpan', 'ApiWishlistController@add');
        Route::delete('/hapus/{id_wishlist}', 'ApiWishlistController@delete');
    });

    Route::group(['prefix' => 'gateway'], function () {
        Route::get('/provinsi', 'RajaOngkirGateway@provinsi');
        Route::get('/kota', 'RajaOngkirGateway@kota');
        Route::get('/kotaId', 'RajaOngkirGateway@kotaId');
        Route::get('/kecamatan', 'RajaOngkirGateway@kecamatan');
        Route::get('/kecamatanId', 'RajaOngkirGateway@kecamatanId');
        Route::post('/tracking', 'RajaOngkirGateway@tracking_check');
    });
});

Route::get('/email/{email}', 'Api\ApiKonsumenController@cek_email');
Route::post('/login', 'Api\Auth\ApiLoginController@login');
Route::post('/keluar', 'Api\Auth\ApiLoginController@keluar');
Route::put('/password/{id_konsumen}', 'Api\ApiKonsumenController@ganti_password');
Route::get('/banner', 'Api\ApiTampilBanner@index');



//rajaongkir gateway
Route::post('/ongkir', 'Api\RajaOngkirGateway@ongkir');
