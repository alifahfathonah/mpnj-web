<?php

namespace App\Repositories;

use App\Models\Produk;

class ProdukRepository
{
    public function all($nama = null)
    {
        return Produk::orderBy('id_produk', 'DESC')
            ->with('foto_produk', 'user', 'kategori')
            ->when($nama != null, function ($query) use ($nama) {
                $query->where('nama_produk', 'like', '%' . $nama . '%');
            })
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
                            'id_pelapak' => $produks->user->id_user,
                            'nama_toko' => $produks->user->nama_toko,
                            'foto_pelapak' => asset('assets/foto_profil_konsumen/' . $produks->user->foto_profil),
                            'alamat' => $produks->user->alamatToko->alamat_lengkap
                        ]
                    ];
                }
            );
    }

    public function produkDiskon()
    {
        return Produk::orderBy('diskon', 'DESC')
            ->with('foto_produk', 'user', 'kategori')
            ->where('diskon', '!=', 0)
            ->get()
            ->map(function ($produks) {
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
                        'foto_pelapak' => asset('assets/foto_profil_konsumen/' . $produks->user->foto_profil),
                        'alamat' => $produks->user->alamatToko->alamat_lengkap
                    ]
                ];
            });
    }

    public function produkLaris()
    {
        return Produk::orderBy('terjual', 'desc')
            ->with('foto_produk', 'user', 'kategori')
            ->get()
            ->map(function ($produks) {
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
                        'foto_pelapak' => asset('assets/foto_profil_konsumen/' . $produks->user->foto_profil),
                        'alamat' => $produks->user->alamatToko->alamat_lengkap
                    ]
                ];
            });
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
                            'id_pelapak' => $produks->user->id_user,
                            'nama_toko' => $produks->user->nama_toko,
                            'foto_pelapak' => asset('assets/foto_profil_konsumen/' . $produks->user->foto_profil),
                            'alamat' => $produks->user->alamatToko->alamat_lengkap,
                            'bergabung' => $produks->user->created_at
                        ]
                    ];
                }
            );
    }
}
