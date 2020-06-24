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
                        'nama_produk' => $pesanan->produk->nama_produk,
                        'jumlah' => $pesanan->jumlah,
                        'harga' => $pesanan->produk->harga_jual,
                        'total_bayar' => $pesanan->transaksi->total_bayar,
                        'bayar_sebelum' => $pesanan->transaksi->batas_transaksi
                    ];
                }
            );
    }
}
