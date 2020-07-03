<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Detail;
use App\Repositories\PesananRepository;
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
        $tab = $request->query('tab');
        $id = $request->query('id');
        $pesanan = $this->pesananRepository->all($id, $tab);
        return $pesanan;
    }

    public function getDetail($id_detail)
    {
        $data = Transaksi_Detail::where('id_transaksi_detail', $id_detail)->get();
        if (count($data) > 0) {
            $pesanan = $this->pesananRepository->detail($id_detail);
            $res['data'] = $pesanan;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        };
    }

    public function terima($id_trx)
    {
        DB::beginTransaction();
        try {
            $find = Transaksi_Detail::with('user')->where('id_transaksi_detail', $id_trx)->first();
            if ($find->update(['status_order' => 'Telah Sampai'])) {
                $updateSaldo = $find->user->update(['saldo' => $find->user->saldo + $find->sub_total]);
                DB::commit();
                return response()->json([
                    'pesan' => 'sukses cok'
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
