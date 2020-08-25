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
                        'id_review' => $review->id_review,
                        'id_produk' => $review->produk_id,
                        'id_user' => $review->user_id,
                        'review' => $review->review,
                        'bintang' => $review->bintang,
                        'foto_review' => $review->foto_review,
                        'reviewer' => $review->user->nama_lengkap
                    ];
                }
            );
    }

    public function reviewNull($id_produk)
    {
        return Review::where('produk_id', $id_produk)
            ->with('produk', 'produk.foto_produk', 'produk.kategori', 'user')
            ->get()
            ->map(
                function ($review) {
                    return null;
                }
            );
    }
}
