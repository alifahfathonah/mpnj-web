<?php

namespace App\Repositories;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiRepository
{
    public function all()
    {
        return Keranjang::orderBy('id_keranjang')
            ->with('pembeli', 'produk')
            ->where('status', 'Y')
            ->get()
            ->map(
                function ($transaksi) {
                    // $keranjang = Keranjang::whereIn('id_keranjang', $transaksi->id_keranjang)->sum(DB::raw("SUM(produk.berat * keranjang.jumlah) as total_berat"));
                    return [
                        'id_keranjang' => $transaksi->id_keranjang,
                        'pembeli' => [
                            'pembeli_id' => $transaksi->pembeli->getKey(),
                            'username' => $transaksi->pembeli->username
                        ],
                        'produk' => [
                            'produk_id' => $transaksi->produk->id_produk,
                            'nama_produk' => $transaksi->produk->nama_produk,
                            'pelapak' => $transaksi->produk->pelapak->nama_toko,
                        ],
                        'status' => $transaksi->status,
                        'jumlah' => $transaksi->jumlah,
                        'harga_jual' => $transaksi->harga_jual
                    ];
                }
            )
            ->groupBy('produk.pelapak');
    }
}
