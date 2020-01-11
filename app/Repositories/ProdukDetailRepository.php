<?php

namespace App\Repositories;

use App\Models\Produk;

class ProdukDetailRepository
{
    public function all()
    {
        return Produk::orderBy('id_produk')
            ->with('kategori')
            ->get()
            ->map(
                function ($produks) {
                    return [
                        'id_produk' => $produks->id_produk,
                        'nama_produk' => $produks->nama_produk,
                        'kategori' => $produks->kategori->nama_kategori
                    ];
                }
            );
    }

    public function findById($id_produk)
    {
        return Produk::where('id_produk', $id_produk)
            ->with('kategori')
            ->firstOrFail();
    }
}
