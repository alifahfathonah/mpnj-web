<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Review;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PesananWebController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $order = Transaksi::with(['transaksi_detail', 'user', 'transaksi_detail.produk.foto_produk'])
            ->when($tab != '', function ($query) use ($tab) {
                $query->whereHas('transaksi_detail', function ($query) use ($tab) {
                    $query->where('status_order', $tab == 'pending' ? ('Menunggu Konfirmasi') : ($tab == 'verifikasi' ? 'Telah Dikonfirmasi' : ($tab == 'packing' ? 'Dikemas' : ($tab == 'dikirim' ? 'Dikirim' : ($tab == 'sukses' ? 'Telah Sampai' : ($tab == 'batal' ? 'Dibatalkan' : ''))))));
                });
            })
            ->where('user_id', Auth::id())
            ->groupBy('kode_transaksi')
            ->get();
        // $data['order'] = Transaksi_Detail::with('transaksi')->get()->where('transaksi.pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
        //     ->where('transaksi.pembeli_id', $konsumen_id)->groupBy('transaksi.kode_transaksi');
        $orderCollect = collect();
        foreach ($order as $key => $value) {
            $orderCollect->push([
                'kode_transaksi' => $value->kode_transaksi,
                'waktu_transaksi' => $value->waktu_transaksi,
                'status_transaksi' => $value->status_transaksi,
                'total_bayar' => $value->total_bayar,
                'proses_pembayaran' => $value->proses_pembayaran,
                'item' => $value->transaksi_detail
            ]);
        }

        $page = $request->query('page');

        $data['order'] = new LengthAwarePaginator(array_slice($orderCollect->toArray(), ($page - 3) * 3, 3), count($orderCollect), 3, $page, ["path" => $tab == '' ? 'pesanan' : 'pesanan?tab='.$tab]);
        return view('web/web_profile', $data);
    }

    public function detail(Request $request, $id_trx)
    {
        $data['detail'] = Transaksi::with('transaksi_detail','transaksi_detail.produk.foto_produk', 'konfirmasi')->where('kode_transaksi', $id_trx)->first();
//        $data['review'] = Review::where('produk_id', $data['detail']->produk_id)->where('konsumen_id', $konsumen_id)->first();

        return view('web/web_profile', $data);
    }

    public function diterima(Request $request, $id_trx)
    {
        $terima = Transaksi_Detail::where('id_transaksi_detail', $id_trx)->update(['status_order' => 'Telah Sampai']);
        if ($terima) {
            return redirect()->back();
        }
    }

    public function dibatalkan(Request $request, $id)
    {
        
       $batalTrx = Transaksi::where('kode_transaksi', $request->kode_transaksi)->update(['status_transaksi' => 'batal']);
       if ($batalTrx) {
           $batalTrxDetail = Transaksi_Detail::where('transaksi_id', $id)->update(['status_order' => 'Dibatalkan']);
           if ($batalTrxDetail) {
               return redirect()->back();
           }
       }
    }

    public function tracking($id)
    {
        $data['detail'] = Transaksi_Detail::with('transaksi')->where('id_transaksi_detail', $id)->first();
        return view('web/web_profile', $data);
    }
}
