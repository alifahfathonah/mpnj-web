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
                        'harga_jual' => $wishlist->produk->harga_jual,
                        'diskon' => $wishlist->produk->diskon,
                        'kategori' => $wishlist->produk->kategori->nama_kategori,
                        'foto_produk' => $wishlist->produk->foto_produk[0]->foto_produk
                    ];
                }
            );
    }
}
