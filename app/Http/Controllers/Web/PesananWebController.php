<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Review;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PesananWebController extends Controller
{
    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;
        //
        $order = Transaksi::with(['transaksi_detail', 'pembeli', 'transaksi_detail.produk.foto_produk'])
                            ->where('pembeli_id', $konsumen_id)
                            ->where('pembeli_type', $role == 'konsumen' ? Konsumen::class : Pelapak::class)
                            ->groupBy('kode_transaksi')
                            ->get();
        // $data['order'] = Transaksi_Detail::with('transaksi')->get()->where('transaksi.pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
        //     ->where('transaksi.pembeli_id', $konsumen_id)->groupBy('transaksi.kode_transaksi');
        $data['order'] = collect();
        foreach ($order as $key => $value) {
            $data['order']->push([
                'kode_transaksi' => $value->kode_transaksi,
                'waktu_transaksi' => $value->waktu_transaksi,
                'total_bayar' => $value->total_bayar,
                'proses_pembayaran' => $value->proses_pembayaran,
                'item' => $value->transaksi_detail
            ]);
        }
        return view('web/web_profile', $data);
        // return $data['order'];
    }

    public function detail(Request $request, $id_trx)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        // $data['detail'] = Transaksi::with(['transaksi_detail' => function ($query) use ($id_trx) {
        //     $query->where('id_transaksi_detail', $id_trx);
        // }])
        //     ->first();
        $data['detail'] = Transaksi::with('transaksi_detail','transaksi_detail.produk.foto_produk')->where('kode_transaksi', $id_trx)->first();
//        $data['review'] = Review::where('produk_id', $data['detail']->produk_id)->where('konsumen_id', $konsumen_id)->first();

        return view('web/web_profile', $data);
//                return $data['detail'];
    }

    public function diterima(Request $request, $id_trx)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $terima = Transaksi_Detail::where('id_transaksi_detail', $id_trx)->update(['status_order' => 'Telah Sampai']);



        return redirect()->back();

    }

    public function dibatalkan(Request $request, $id_trx)
    {
        
       Transaksi::where('id_transaksi', $request->id )->update(['total_bayar' => $request->total3]);
       Transaksi_Detail::where('id_transaksi_detail', $id_trx)->update(['status_order' => 'batal']);
        return redirect()->back();
        
    }
}
