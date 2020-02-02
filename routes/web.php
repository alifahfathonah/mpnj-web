<?php

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

Route::get('/', function () {
    return view('welcome');
});

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
Route::get('produk', 'Web\ProdukWebController@index');
Route::get('produk/{id}', 'Web\ProdukWebController@produkId');

//daftar
// Route::get('daftar', 'Web\KonsumenWebController@index');
Route::post('daftar/simpan', 'Web\KonsumenWebController@simpan')->name('daftarSimpan');
Route::get('kotaByProvinsiId/{id}', 'Web\KonsumenWebController@kotaByProvinsiId');

Auth::routes();
Route::get('keluar', 'Auth\LoginController@keluar')->name('keluar');

//keranjang
Route::get('keranjang', 'Web\KeranjangWebController@index');
Route::post('keranjang', 'Web\KeranjangWebController@simpan');
Route::get('keranjang/hapus/{id}', 'Web\KeranjangWebController@hapus');
Route::post('keranjang/hitungTotal', 'Web\KeranjangWebController@hitungTotal');
Route::post('keranjang/ambilHarga', 'Web\KeranjangWebController@ambilHarga');
Route::post('keranjang/updateJumlah', 'Web\KeranjangWebController@updateJumlah');
Route::post('keranjang/go_checkout', 'Web\KeranjangWebController@go_checkout');

//checkout
Route::get('checkout', 'Web\CheckoutWebController@index');
Route::post('/simpanTransaksi', 'Web\CheckoutWebController@simpanTransaksi');
Route::get('sukses/{kodeTrx}', 'Web\CheckoutWebController@sukses');

//konfirmasi
Route::get('konfirmasi', 'Web\KonfirmasiWebController@index');
Route::get('konfirmasi/data', 'Web\KonfirmasiWebController@data');
Route::post('konfirmasi/data', 'Web\KonfirmasiWebController@data');
Route::post('konfirmasi/simpan', 'Web\KonfirmasiWebController@simpan');

//pesanan
Route::get('pesanan', 'Web\PesananWebController@index');
Route::get('pesanan/detail/{id}', 'Web\PesananWebController@detail');

//konsumen profile
Route::get('profile', 'Web\ProfileWebController@index');
Route::get('/home', 'HomeController@index')->name('home');

//pelapak
Route::get('jual', 'Pelapak\PelapakController@index');
