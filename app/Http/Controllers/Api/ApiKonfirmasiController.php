<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Repositories\KonfirmasiRepository;
use Illuminate\Http\Request;

class ApiKonfirmasiController extends Controller
{

    private $konfirmasiRepository;

    public function __construct(KonfirmasiRepository $konfirmasiRepository)
    {
        $this->konfirmasiRepository = $konfirmasiRepository;
    }

    public function tampilData($kode_transaksi)
    {
        $data = Transaksi::where('kode_transaksi', $kode_transaksi)->get();
        if (count($data) > 0) {
            $konfirm = $this->konfirmasiRepository->dataKonfirmasi($kode_transaksi);
            $res['pesan'] = "Sukses!";
            $res['data'] = $konfirm;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        };
    }
}
