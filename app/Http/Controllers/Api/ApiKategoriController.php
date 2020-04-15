<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori_Produk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ApiKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori_Produk::all();
        return response()->json($kategori, 200);
    }

    public function produk($id)
    {
        $produk = Kategori_Produk::with('produk')->where('id_kategori_produk', $id)->first();
        if ($produk != null) {
            if ($produk->produk->count() > 0) {
                return $produk->produk->map(function($produks) {
                    return [
                        'id_produk' => $produks->id_produk,
                        'nama_produk' => $produks->nama_produk,
                        'kategori' => [
                            'id_kategori' => $produks->kategori->id_kategori_produk,
                            'nama_kategori' => $produks->kategori->nama_kategori
                        ],
                        'satuan' => $produks->satuan,
                        'berat' => $produks->berat,
                        'harga_modal' => $produks->harga_modal,
                        'harga_jual' => $produks->harga_jual,
                        'diskon' => $produks->diskon,
                        'stok' => $produks->stok,
                        'keterangan' => $produks->keterangan,
                        'tipe_produk' => $produks->tipe_produk,
                        'wishlist' => $produks->wishlist,
                        'terjual' => $produks->terjual,
                        'foto' => $produks->foto_produk->map(function ($foto) {
                            return [
                                'id_foto_poroduk' => $foto->id_foto_produk,
                                'foto_produk' => $foto->foto_produk
                            ];
                        }),
                        'pelapak' => [
                            'id_pelapak' => $produks->user->id_user,
                            'nama_toko' => $produks->user->nama_toko,
                            'foto_pelapak' => asset('assets/foto_profil_konsumen/'.$produks->user->foto_profil),
                            'alamat' => $produks->user->alamat_utama
                        ]
                    ];
                });
            } else {
                return response()->json($produk->produk, 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'pesan' => 'data tidak ditemukan'
            ], 404);
        }
    }
}
