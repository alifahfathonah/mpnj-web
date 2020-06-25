<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Detail;
use App\Repositories\PesananRepository;
use Illuminate\Http\Request;

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
}
