<?php

namespace App\Repositories;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangRepository
{
    public function all()
    {
        return Keranjang::orderBy('id_keranjang')
            ->with('konsumen', 'produk')
            ->get()
            ->map(
                function ($keranjangs) {
                    return [
                        'id_keranjang' => $keranjangs->id_keranjang,
                        'konsumen' => [
                            'konsumen_id' => $keranjangs->konsumen->id_konsumen,
                            'username' => $keranjangs->konsumen->username
                        ],
                        'produk' => [
                            'produk_id' => $keranjangs->produk->id_produk,
                            'nama_produk' => $keranjangs->produk->nama_produk,
                            'pelapak' => $keranjangs->produk->pelapak->nama_toko
                        ],
                        'status' => $keranjangs->status,
                        'jumlah' => $keranjangs->jumlah,
                        'harga_jual' => $keranjangs->harga_jual
                    ];
                }
            );
    }

    public function create($data)
    {
        return Keranjang::create($data);
    }
}
