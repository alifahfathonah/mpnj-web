<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Pengiriman;
use App\Models\Review;
use App\Models\Transaksi;
use App\Models\Produk;
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
        $transaksi = Transaksi::with(['transaksi_detail' => function ($query) use ($tab) {
            $query->when($tab != '', function ($query) use ($tab) {
                $query->where('status_order', $tab == 'pending' ? ('Menunggu Konfirmasi') : ($tab == 'verifikasi' ? 'Telah Dikonfirmasi' : ($tab == 'packing' ? 'Dikemas' : ($tab == 'dikirim' ? 'Dikirim' : ($tab == 'sukses' ? 'Telah Sampai' : ($tab == 'batal' ? 'Dibatalkan' : ''))))));
            });
        }])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();

        $data['order'] = [];
        foreach ($transaksi as $t) {
            if ($t->transaksi_detail->count() > 0) {
                array_push($data['order'], $t);
            }
        }
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
        }
    }

    public function dibatalkan($id)
    {
        $batalTrx = Transaksi_Detail::where('transaksi_id', $id)->update(['status_order' => 'Dibatalkan']);
        if ($batalTrx) {
            return redirect()->back()->with('trxBatalSukses', 'Transaksi ini sudah dibatalkan dan akan diproses lagi');
        }
    }

    public function diterima(Request $request, $kode_invoice)
    {
        DB::beginTransaction();
        try {
            $terima = Transaksi_Detail::where('kode_invoice', $kode_invoice)->get();
            $ongkir = Pengiriman::select('ongkir')->where('kode_invoice', $kode_invoice)->first();
            foreach ($terima as $t) {
                $t->update(['status_order' => 'Telah Sampai']);
                Produk::where('id_produk', $t->produk_id)->decrement('stok', $t->jumlah);
            }
            $saldo = $terima->sum('sub_total') + $ongkir->ongkir;
            $updateSaldo = $terima[0]->user->update(['saldo' => $terima[0]->user->saldo + $saldo]);
            DB::commit();
            return redirect()->back()->with('trxSukses', 'Selamat, transaksi anda telah selesai. Terima kasih.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function exportInvoice(Request $request)
    {
        $id_transaksi = $request->query('id');
        $invoice = $request->query('inv');
        $data['d'] = Transaksi::with(['transaksi_detail' => function ($query) use ($invoice) {
            $query->where('kode_invoice', $invoice);
        }])
            ->where('id_transaksi', $id_transaksi)
            ->first();
        $data['pengiriman'] = Pengiriman::where('kode_invoice', $invoice)->first();
        $pdf = PDF::loadView('web.profile.pesanan_invoice', $data);
        set_time_limit(60);
        return $pdf->download('invoiceBelaNj-' . $invoice . '.pdf');
    }

    public function tracking($kode_invoice)
    {
        $data['detail'] = Pengiriman::where('kode_invoice', $kode_invoice)->first();
        return view('web/web_profile', $data);
    }
}
