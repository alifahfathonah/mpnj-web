<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use App\Repositories\PesananRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPesananController extends Controller
{
    private $pesananRepository;

    public function __construct(PesananRepository $pesananRepository)
    {
        $this->pesananRepository = $pesananRepository;
    }

    public function index(Request $request)
    {
        $id = $request->query('id');
        $tab = $request->query('tab');

        $pesanan = Transaksi_Detail::orderBy('created_at', 'DESC')
            ->with('produk', 'transaksi')
            ->whereHas('transaksi', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->when($tab != '', function ($query) use ($tab) {
                $query->where('status_order', $tab == 'pending' ? ('Menunggu Konfirmasi') : ($tab == 'verifikasi' ? 'Telah Dikonfirmasi' : ($tab == 'packing' ? 'Dikemas' : ($tab == 'dikirim' ? 'Dikirim' : ($tab == 'sukses' ? 'Telah Sampai' : ($tab == 'batal' ? 'Dibatalkan' : ''))))));
            })
            ->get()
            ->groupBy('kode_invoice');

        $invoice = collect();
        foreach ($pesanan as $key => $p) {
            $item = collect();
            foreach ($p as $p) {
                $item->push([
                    'nama_produk' => $p->produk->nama_produk,
                    'foto' => $p->produk->foto_produk[0]->foto_produk,
                    'harga_jual' => $p->produk->harga_jual,
                    'status_order' => $p->status_order
                ]);
            }
            $invoice->push([
                'kode_invoice' => $key,
                'nama_toko' => $p->user->nama_toko,
                'jumlah_pesanan' => $pesanan[$key]->count(),
                'waktu_transaksi' => Carbon::parse($p->transaksi->waktu_transaksi)->format('d-m-Y H:i:s'),
                'total_pembayaran' => $pesanan[$key]->sum('sub_total'),
                'item' => $item
            ]);
        }

        return response()->json([
            'data_pesanan' => $invoice
        ], 200);
    }

    public function getDetail($kode_invoice)
    {
        $data = Transaksi_Detail::where('kode_invoice', $kode_invoice)->get();
        if (count($data) > 0) {
            $pesanan = $this->pesananRepository->detail($kode_invoice);
            $res['data'] = $pesanan;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        };
    }

    public function terima(Request $request)
    {
        DB::beginTransaction();
        try {
            $find = Transaksi_Detail::with('user')->where('id_transaksi_detail', $request->id_transaksi_detail)->get();
            $update = $find->each(function ($trx) {
                $trx->update(['status_order' => 'Telah Sampai']);
                // exit;
            });
            if ($update) {
                // $findw = Transaksi_Detail::with('user')->where('transaksi_id', $find->transaksi_id)->get();
                // $findUser = User::where('id_user', $find->user->user_id)->first();
                // $updateSaldo = $find->user->each(function ($sld) {
                //     $sld->update(['saldo' => '3000']);
                // });
                DB::commit();
                return response()->json([
                    'pesan' => 'sukses cok',
                    'data' => $find,
                    // 'data2' => $findUser
                ], 200);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'pesan' => 'gagal'
            ], 404);
        }
    }
}
