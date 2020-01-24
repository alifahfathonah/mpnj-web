<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use App\Repositories\TransaksiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApiTransaksiController extends Controller
{
    private $transaksiRepository;

    public function __construct(TransaksiRepository $transaksiRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function index()
    {
        $transaksi = $this->transaksiRepository->all();
        return $transaksi;
    }

    public function simpan(Request $request)
    {
        $role = Session::get('role');
        //$id = Session::get('id');
        //$konsumen_id = $request->user($role)->$id;

        $data = array(
            'pembeli_id' => $request->pembeli_id,
            'pembeli_type' => $request->$role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak',
            'kode_transaksi' => time(),
            'waktu_transaksi' => date('Y-m-d H:i:s'),
            'total_bayar' => $request->total_bayar
        );

        $transaksi = $this->transaksiRepository->create($data);
        if ($transaksi) {
            // foreach ($request->trxDetail as $detail) {
            //     $detail['transaksi_id'] = $transaksi->id_transaksi;
            //     Transaksi_Detail::create($detail);
            // }
            return response()->json(
                [
                    'kode_transaksi' => $transaksi->kode_transaksi,
                    'total_bayar' => $transaksi->total_bayar
                ],
                200
            );
        } else {
            return response()->json('gagal', 400);
        }
    }
}
