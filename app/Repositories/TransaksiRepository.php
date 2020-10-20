<?php

namespace App\Repositories;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Carbon\Carbon;
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

    public function tglTransaksi($kode_transaksi)
    {
        return Transaksi::where('kode_transaksi', $kode_transaksi)
            // select('id_transaksi', 'kode_transaksi', 'waktu_transaksi', 'batas_transaksi')
            ->get()
            ->map(
                function ($tglTrk) {
                    return [
                        'id_transaksi' => $tglTrk->id_transaksi,
                        'kode_transaksi' => $tglTrk->kode_transaksi,
                        'waktu_transaksi' => Carbon::parse($tglTrk->waktu_transaksi)->format('d-m-Y H:i:s'),
                        'batas_transaksi' => Carbon::parse($tglTrk->batas_transaksi)->format('d-m-Y H:i:s')
                    ];
                }
            );
    }

    public function create($data)
    {
        return Transaksi::create($data);
    }
}
