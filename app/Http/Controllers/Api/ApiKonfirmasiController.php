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
        // return $request->kode_transaksi;
        $konfirm = new Konfirmasi;
        $konfirm->kode_transaksi = $request->kode_transaksi;
        $konfirm->total_transfer = $request->total_transfer;
        $konfirm->rekening_admin_id = $request->rekening_admin_id;
        $konfirm->nama_pengirim = $request->nama_pengirim;
        $konfirm->tanggal_transfer = date('Y-m-d');
        
        $file = $request->file('bukti_transfer');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move('assets/foto_bukti_tf', $name);
        // // $file = $konfirm['base64_image'];
        $konfirm->bukti_transfer = $name;
        $simpan = $konfirm->save();

        if ($simpan) {
            // $file->move($file);
            $res['pesan'] = "Tambah Data Produk Sukses!";
            $res['data'] = [$konfirm];

            return response()->json($res, 201);
        } else {
            $res2['pesan'] = "Tambah Data produk Gagal!";
            return response()->json($res2);
        }
    }
}
