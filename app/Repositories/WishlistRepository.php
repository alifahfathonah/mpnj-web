<?php

namespace App\Repositories;

use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;

class WishlistRepository
{
    public function dataWishlist($id_user)
    {
        return Wishlist::orderBy('id_wishlist')
            ->where('user_id', $id_user)
            ->with('user', 'produk', 'produk.kategori', 'produk.foto_produk')
            ->get()
            ->map(
                function ($wishlist) {
                    return [
                        'id_wishlist' => $wishlist->id_wishlist,
                        'id_user' => $wishlist->user_id,
                        'id_produk' => $wishlist->produk_id,
                        'nama_produk' => $wishlist->produk->nama_produk,
                        'kategori' => [
                            'id_kategori' => $wishlist->produk->kategori->id_kategori_produk,
                            'nama_kategori' => $wishlist->produk->kategori->nama_kategori
                        ],
                        'satuan' => $wishlist->produk->satuan,
                        'berat' => $wishlist->produk->berat,
                        'harga_modal' => $wishlist->produk->harga_modal,
                        'harga_jual' => $wishlist->produk->harga_jual,
                        'stok' => $wishlist->produk->stok,
                        'diskon' => $wishlist->produk->diskon,
                        'keterangan' => $wishlist->produk->keterangan,
                        'tipe_produk' => $wishlist->produk->tipe_produk,
                        'wishlist' => $wishlist->produk->wishlist,
                        'terjual' => $wishlist->produk->terjual,
                        'foto' => $wishlist->produk->foto_produk->map(function ($foto) {
                            return [
                                'id_foto_poroduk' => $foto->id_foto_produk,
                                'foto_produk' => $foto->foto_produk
                            ];
                        }),
                        'pelapak' => [
                            'id_pelapak' => $wishlist->produk->user->id_user,
                            'nama_toko' => $wishlist->produk->user->nama_toko,
                            'foto_pelapak' => asset('assets/foto_profil_konsumen/' . $wishlist->produk->user->foto_profil),
                            'alamat' => $wishlist->produk->user->alamatToko->alamat_lengkap,
                            'bergabung' => $wishlist->produk->user->created_at
                        ]
                    ];
                }
            );
    }
}
