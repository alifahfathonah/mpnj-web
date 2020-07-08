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
                        'produk' => [
                            'id_produk' => $review->produk->id_produk,
                            'nama_produk' => $review->produk->nama_produk,
                            'kategori' => $review->produk->kategori->nama_kategori,
                            'foto' => $review->produk->foto_produk[0]->foto_produk,
                            'id_pelapak' => $review->user->id_user,
                            'nama_toko' => $review->user->nama_toko,
                        ],
                        'review' => [
                            'id_review' => $review->id_review,
                            'id_produk' => $review->produk_id,
                            'id_user' => $review->user_id,
                            'review' => $review->review,
                            'bintang' => $review->bintang,
                            'foto_review' => $review->foto_review
                        ]

                    ];
                }
            );
    }
                    ];
                }
            );
    }
}
