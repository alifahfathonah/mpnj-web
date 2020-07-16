<?php

namespace App\Repositories;

use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;

class PesananRepository
{
    public function all($id, $tab)
    {
        // $tab = $request->query('tab');
        return Transaksi_Detail::whereHas('transaksi', function ($query) use ($id) {
            $query->where('user_id', $id);
        })
            ->when($tab != '', function ($query) use ($tab) {
                $query->where('status_order', $tab == 'pending' ? ('Menunggu Konfirmasi') : ($tab == 'verifikasi' ? 'Telah Dikonfirmasi' : ($tab == 'packing' ? 'Dikemas' : ($tab == 'dikirim' ? 'Dikirim' : ($tab == 'sukses' ? 'Telah Sampai' : ($tab == 'batal' ? 'Dibatalkan' : ''))))));
            })
            ->orderBy('created_at', 'DESC')
            ->with('produk', 'user', 'transaksi')
            ->get()
            ->map(
                function ($pesanan) {
                    return [
                        'id_transaksi_detail' => $pesanan->id_transaksi_detail,
                        'nama_toko' => $pesanan->user->nama_toko,
                        'status_pembayaran' => $pesanan->transaksi->proses_pembayaran,
                        'foto_produk' => $pesanan->produk->foto_produk[0]->foto_produk,
                        'nama_produk' => $pesanan->produk->nama_produk,
                        'jumlah' => $pesanan->jumlah,
                        'harga' => $pesanan->produk->harga_jual,
                        'total_bayar' => $pesanan->transaksi->total_bayar,
                        'bayar_sebelum' => $pesanan->transaksi->batas_transaksi,
                        'status_order' => $pesanan->status_order
                    ];
                }
            );
    }

    public function detail($kode_invoice)
    {
        return Transaksi_Detail::where('kode_invoice', $kode_invoice)
            ->with('produk', 'user', 'transaksi', 'transaksi.konfirmasi', 'pengiriman')
            ->get()
            ->map(
                function ($pesanan) {
                    return [
                        'id_transaksi_detail' => $pesanan->id_transaksi_detail,
                        'status_pembayaran' => $pesanan->transaksi->proses_pembayaran,
                        'total_bayar' => $pesanan->transaksi->total_bayar,
                        'nama_toko' => $pesanan->user->nama_toko,
                        'nama_produk' => $pesanan->produk->nama_produk,
                        'foto_produk' => $pesanan->produk->foto_produk[0]->foto_produk,
                        'jumlah' => $pesanan->jumlah,
                        'harga' => $pesanan->diskon == 0 ? $pesanan->produk->harga_jual : $pesanan->produk->harga_jual - ($pesanan->produk->harga_jual / 100 * $pesanan->produk->harga_jual),
                        'kurir' => $pesanan->pengiriman->kurir,
                        'ongkir' => $pesanan->pengiriman->ongkir,
                        'service' => $pesanan->pengiriman->service,
                        'etd' => $pesanan->pengiriman->etd,
                        'tujuan' => $pesanan->transaksi->to,
                        'no_pesanan' => $pesanan->transaksi->kode_transaksi,
                        'waktu_pesan' => $pesanan->transaksi->waktu_transaksi,
                        'bayar_sebelum' => $pesanan->transaksi->batas_transaksi,
                        'status_order' => $pesanan->status_order
                    ];
                }
            );
    }
}
