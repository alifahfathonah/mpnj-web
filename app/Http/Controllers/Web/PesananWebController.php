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
use PDF;

class PesananWebController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $data['order'] = Transaksi_Detail::with(['transaksi' => function($query) use ($tab) {
            $query->where('user_id', Auth::id());
        }])
        ->when($tab != '', function ($query) use ($tab) {
            $query->where('status_order', $tab == 'pending' ? ('Menunggu Konfirmasi') : ($tab == 'verifikasi' ? 'Telah Dikonfirmasi' : ($tab == 'packing' ? 'Dikemas' : ($tab == 'dikirim' ? 'Dikirim' : ($tab == 'sukses' ? 'Telah Sampai' : ($tab == 'batal' ? 'Dibatalkan' : ''))))));
        })
        ->paginate(5);

        return view('web/web_profile', $data);
    }

    public function detail(Request $request, $id_trx)
    {
        $data['detail'] = Transaksi::with('transaksi_detail', 'transaksi_detail.produk.foto_produk', 'konfirmasi')->where('kode_transaksi', $id_trx)->first();
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

    public function exportInvoice(Request $request, $id_transaksi_detail)
    {
        // $id_transaksi = $request->query('id_transaksi');
        $data['d'] = Transaksi_Detail::with(['transaksi', 'user'])->where('id_transaksi_detail', $id_transaksi_detail)->first();
        $pdf = PDF::loadView('web.profile.pesanan_invoice', $data);
        set_time_limit(60);
        return $pdf->download('invoiceBelaNj-' . $data['d']->id_transaksi . '.pdf');
        // return view('web.profile.pesanan_invoice', $data);
    }

    public function tracking($id)
    {
        $data['detail'] = Transaksi_Detail::with('transaksi')->where('id_transaksi_detail', $id)->first();
        return view('web/web_profile', $data);
    }
}
