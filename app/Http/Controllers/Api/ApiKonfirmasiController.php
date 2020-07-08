<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konfirmasi;
use App\Models\Transaksi;
use App\Repositories\KonfirmasiRepository;
use Illuminate\Http\Request;
use File;

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

    public function simpan(Request $request)
    {
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $dataKonfirmasi = [
            'kode_transaksi' => $request->kode_transaksi,
            'total_transfer' => $request->total_transfer,
            'rekening_admin_id' => $request->rekening_admin_id,
            'nama_pengirim' => $request->nama_pengirim,
            'tanggal_transfer' => date('Y-m-d H:i:s'),
            'bukti_transfer' => $name
        ];

        $simpanKonfirmasi = Konfirmasi::create($dataKonfirmasi);

        if ($simpanKonfirmasi) {
            Transaksi::where('kode_transaksi', $request->kode_transaksi)->update(['proses_pembayaran' => 'sudah']);
            $file->move('assets/foto_bukti_tf', $name);
            $res['pesan'] = "Konfirmasi Pembayaran Sukses Sukses!";
            $res['data'] = $dataKonfirmasi;

            return response()->json($res, 201);
        } else {
            $res2['pesan'] = "Konfirmasi Pembayaran Sukses Gagal!";
            return response()->json($res2);
        }
    }
}
