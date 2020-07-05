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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class PesananWebController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $data['order'] = Transaksi::with(['transaksi_detail' => function ($query) use ($tab) {
            $query->when($tab != '', function ($query) use ($tab) {
                $query->where('status_order', $tab == 'pending' ? ('Menunggu Konfirmasi') : ($tab == 'verifikasi' ? 'Telah Dikonfirmasi' : ($tab == 'packing' ? 'Dikemas' : ($tab == 'dikirim' ? 'Dikirim' : ($tab == 'sukses' ? 'Telah Sampai' : ($tab == 'batal' ? 'Dibatalkan' : ''))))));
            });
        }])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('web/web_profile', $data);
    }

    public function detail(Request $request)
    {
        $inv = $request->query('inv');
        $id = $request->query('id');
        $data['detail'] = Transaksi::with(['transaksi_detail' => function ($query) use ($inv) {
            $query->with('pengiriman')->when(!is_null($inv), function ($query) use ($inv) {
                $query->where('kode_invoice', $inv);
            });
        }])
            ->where('id_transaksi', $id)
            ->first();

        if ($data['detail'] != '') {
            if ($data['detail']->transaksi_detail->count() > 0) {
                return view('web/web_profile', $data);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->to('pesanan');
        }
    }

    public function dibatalkan($id)
    {
        $batalTrx = Transaksi_Detail::where('transaksi_id', $id)->update(['status_order' => 'Dibatalkan']);
        if ($batalTrx) {
            return redirect()->back()->with('trxBatalSukses', 'Transaksi ini sudah dibatalkan dan akan diproses lagi');
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
