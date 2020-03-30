<?php

namespace App\Repositories;

use App\Models\Produk;

class ProdukRepository
{
    public function all()
    {
        return Produk::orderBy('id_produk')
            ->with('foto_produk', 'pelapak', 'kategori')
            ->get()
            ->map(
                function ($produks) {
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
                            'id_pelapak' => $produks->pelapak->id_pelapak,
                            'nama_toko' => $produks->pelapak->nama_toko,
                            'foto_pelapak' => $produks->pelapak->foto_profil,
                            'alamat' => $produks->pelapak->alamat
                        ]
                    ];
                }
            );
    }

    public function findById($id_produk)
    {
        return Produk::where('id_produk', $id_produk)
            ->with('kategori', 'foto_produk')
            ->get()
            ->map(
                function ($produks) {
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
                        'stok' => $produks->stok,
                        'diskon' => $produks->diskon,
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
                            'id_pelapak' => $produks->pelapak->id_pelapak,
                            'nama_toko' => $produks->pelapak->nama_toko,
                            'foto_pelapak' => $produks->pelapak->foto_profil,
                            'alamat' => $produks->pelapak->alamat,
                            'bergabung' => $produks->pelapak->created_at
                        ]
                    ];
                }
            );
    }
}
