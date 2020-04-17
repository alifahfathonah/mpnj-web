<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Review;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PesananWebController extends Controller
{
    public function index(Request $request)
    {
        $order = Transaksi::with(['transaksi_detail', 'user', 'transaksi_detail.produk.foto_produk'])
                            ->where('user_id', Auth::check())
                            ->groupBy('kode_transaksi')
                            ->get();
        // $data['order'] = Transaksi_Detail::with('transaksi')->get()->where('transaksi.pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
        //     ->where('transaksi.pembeli_id', $konsumen_id)->groupBy('transaksi.kode_transaksi');
        $data['order'] = collect();
        foreach ($order as $key => $value) {
            $data['order']->push([
                'kode_transaksi' => $value->kode_transaksi,
                'waktu_transaksi' => $value->waktu_transaksi,
                'status_transaksi' => $value->status_transaksi,
                'total_bayar' => $value->total_bayar,
                'proses_pembayaran' => $value->proses_pembayaran,
                'item' => $value->transaksi_detail
            ]);
        }
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
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $terima = Transaksi_Detail::where('id_transaksi_detail', $id_trx)->update(['status_order' => 'Telah Sampai']);

        return redirect()->back();
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
