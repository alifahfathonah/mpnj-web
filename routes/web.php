<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//produk
Route::get('administrator/produk', 'ProdukController@index');
Route::get('administrator/produk/tambah', 'ProdukController@tambah');
Route::post('administrator/produk/simpan', 'ProdukController@simpan');
Route::get('administrator/produk/edit/{id}', 'ProdukController@edit');
Route::post('administrator/produk/ubah/{id}', 'ProdukController@ubah');
Route::get('administrator/produk/hapus/{id}', 'ProdukController@hapus');
Route::post('administrator/produk/upload_foto', 'ProdukController@upload_foto');
Route::post('administrator/produk/unlink', 'ProdukController@unlink');

//rekening
Route::get('administrator/rekening', 'RekeningPelapakController@index');
Route::get('administrator/rekening/tambah', 'RekeningPelapakController@tambah');
Route::post('administrator/rekening/simpan', 'RekeningPelapakController@simpan');
Route::get('administrator/rekening/edit/{id}', 'RekeningPelapakController@edit');
Route::post('administrator/rekening/ubah/{id}', 'RekeningPelapakController@ubah');
Route::get('administrator/rekening/hapus/{id}', 'RekeningPelapakController@hapus');

//transaksi
Route::get('administrator/transaksi', 'Pelapak\PelapakTransaksiController@index');
Route::get('administrator/transaksi/detail/{id}', 'Pelapak\PelapakTransaksiController@detail');
Route::get('adminstrator/transaksi/status/edit/{id}/{status}/{id_trx}', 'Pelapak\PelapakTransaksiController@update_status');

//web produk
Route::get('/', 'Web\ProdukWebController@index');

Route::group(['namespace' => 'Web'], function () {
    Route::group(['prefix' => 'produk'], function () {
        Route::get('/', 'ProdukWebController@produk');
        Route::get('popular', 'ProdukWebController@popular');
        Route::get('{id}', 'ProdukWebController@produkId');
    });

    Route::group(['prefix' => 'keranjang'], function () {
        Route::get('/', 'KeranjangWebController@index')->middleware('checkUserLogin');
        Route::post('/', 'KeranjangWebController@simpan')->middleware('checkUserLogin');
        Route::get('hapus/{id}', 'KeranjangWebController@hapus');
        Route::post('hitungTotal', 'KeranjangWebController@hitungTotal');
        Route::post('ambilHarga', 'KeranjangWebController@ambilHarga');
        Route::post('updateJumlah', 'KeranjangWebController@updateJumlah');
        Route::post('go_checkout', 'KeranjangWebController@go_checkout');
    });

    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/', 'CheckoutWebController@index');
        Route::post('simpanTransaksi', 'CheckoutWebController@simpanTransaksi');
        Route::get('sukses/{kodeTrx}', 'CheckoutWebController@sukses')->middleware('checkUserLogin');
        Route::post('batal', 'CheckoutWebController@batal');
    });

    Route::group(['prefix' => 'konfirmasi'], function () {
        Route::get('/', 'KonfirmasiWebController@index')->middleware('checkUserLogin');
        Route::get('data', 'KonfirmasiWebController@data')->middleware('checkUserLogin');
        Route::get('data/{id}', 'KonfirmasiWebController@data');
        Route::get('cek', 'KonfirmasiWebController@cek')->name('cek');
        Route::post('simpan', 'KonfirmasiWebController@simpan');
        Route::get('akun/{id}', 'KonfirmasiWebController@akun');
        Route::get('verified', 'KonfirmasiWebController@verified');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileWebController@index')->name('profile')->middleware('checkUserLogin');
        Route::post('ubah/{role}/{id}', 'ProfileWebController@ubah');
        Route::post('gantipassword/{id}', 'ProfileWebController@gantipassword');
        Route::get('rekening', 'ProfileWebController@rekening')->name('rekening');
        Route::get('alamat', 'ProfileWebController@alamat')->name('alamat')->middleware('checkUserLogin');
        Route::post('alamat/simpan', 'ProfileWebController@simpan_alamat');
        Route::post('alamat/ubah/{id}', 'ProfileWebController@ubah_alamat');
        Route::get('alamat/hapus/{id}', 'ProfileWebController@hapus_alamat');
        Route::get('alamat/ubah/utama/{id}', 'ProfileWebController@ubah_alamat_utama');
    });

    Route::group(['prefix' => 'pesanan'], function () {
        Route::get('/', 'PesananWebController@index')->name('pesanan')->middleware('checkUserLogin');
        Route::get('detail/{id_trx}', 'PesananWebController@detail')->name('pesananDetail')->middleware('checkUserLogin');
        Route::get('diterima/{id}', 'PesananWebController@diterima')->name('pesananDetail')->middleware('checkUserLogin');
        Route::post('dibatalkan/{id}', 'PesananWebController@dibatalkan');
        Route::get('tracking/{id}', 'PesananWebController@tracking')->name('tracking');
    });

    Route::group(['prefix' => 'pelapak'], function () {
        Route::get('{username}', 'PelapakWebController@index')->name('halaman_pelapak');
        Route::get('{username}/produk', 'PelapakWebController@produk')->name('halaman_produk_pelapak');
    });
});

//daftar
// Route::get('daftar', 'Web\KonsumenWebController@index');
Route::post('daftar/simpan', 'Web\KonsumenWebController@simpan')->name('daftarSimpan');
Route::get('kotaByProvinsiId/{id}', 'Web\KonsumenWebController@kotaByProvinsiId');

Auth::routes();
//reset password
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@upadate_password');
Route::post('password/update', 'Auth\ResetPasswordController@upadate_password');
Route::get('keluar', 'Auth\LoginController@keluar')->name('keluar');

Route::get('/home', 'HomeController@index')->name('home');

//pelapak
Route::get('jual', 'Pelapak\PelapakController@index');

//review
Route::post('review/produk', 'Web\ReviewWebController@postReview');
