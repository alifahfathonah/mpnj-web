<?php

namespace App\Repositories;

use App\Models\Produk;
use App\Models\Review;

class ReviewRepository
{
    public function findById($id_produk)
    {
        return Review::where('produk_id', $id_produk)
            ->with('produk', 'produk.foto_produk', 'produk.kategori', 'user')
            ->get()
            ->map(
                function ($review) {
                    return [
                        'id_produk' => $review->produk->id_produk,
                        'nama_produk' => $review->produk->nama_produk,
                        'kategori' => [
                            'id_kategori' => $review->produk->kategori->id_kategori_produk,
                            'nama_kategori' => $review->produk->kategori->nama_kategori
                        ],
                        'foto' => $review->produk->foto_produk[0]->foto_produk,
                        'pelapak' => [
                            'id_pelapak' => $review->user->id_user,
                            'nama_toko' => $review->user->nama_toko,
                        ]
                    ];
                }
            );
    }
}
