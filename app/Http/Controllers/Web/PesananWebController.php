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
        $data['order'] = Transaksi_Detail::whereHas('transaksi', function ($query) use ($tab) {
            $query->where('user_id', Auth::id());
        })
            ->when($tab != '', function ($query) use ($tab) {
                $query->where('status_order', $tab == 'pending' ? ('Menunggu Konfirmasi') : ($tab == 'verifikasi' ? 'Telah Dikonfirmasi' : ($tab == 'packing' ? 'Dikemas' : ($tab == 'dikirim' ? 'Dikirim' : ($tab == 'sukses' ? 'Telah Sampai' : ($tab == 'batal' ? 'Dibatalkan' : ''))))));
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('web/web_profile', $data);
        // return $data;
    }

    public function detail(Request $request, $id_trx_detail)
    {
        $data['detail'] = Transaksi_Detail::with('transaksi', 'transaksi.konfirmasi')->where('id_transaksi_detail', $id_trx_detail)->first();

        return view('web/web_profile', $data);
    }

    public function diterima(Request $request, $id_trx)
    {
        DB::beginTransaction();
        try {
            $terima = Transaksi_Detail::where('id_transaksi_detail', $id_trx)->first();
            if ($terima->update(['status_order' => 'Telah Sampai'])) {
                $updateSaldo = $terima->user->update(['saldo' => $terima->sub_total]);
                DB::commit();
                return redirect()->back()->with('trxSukses', 'Selamat, transaksi anda telah selesai. Terima kasih.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function dibatalkan($id)
    {
        $batalTrx = Transaksi_Detail::where('id_transaksi_detail', $id)->update(['status_order' => 'Dibatalkan']);
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
