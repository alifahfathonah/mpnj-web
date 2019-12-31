<?php

namespace App\Http\Controllers;

use App\Models\Rekening_Pelapak;
use Illuminate\Http\Request;

class RekeningPelapakController extends Controller
{
    public function index()
    {
        $data['rekening'] = Rekening_Pelapak::where('pelapak_id', 1)->get();
        return view('pelapak/rekening/data_rekening', $data);
    }

    public function tambah()
    {
        return view('pelapak/rekening/tambah_rekening');
    }

    public function simpan(Request $request)
    {
        $simpanRekening = Rekening_Pelapak::create([
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'atas_nama' => $request->atas_nama,
            'pelapak_id' => 1
        ]);

        if ($simpanRekening) {
            return redirect('administrator/rekening');
        }
    }
}
