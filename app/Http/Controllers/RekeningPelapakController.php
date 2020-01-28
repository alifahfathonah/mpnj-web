<?php

namespace App\Http\Controllers;

use App\Models\Rekening_Pelapak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $simpanRekening = Rekening_Pelapak::create([
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'atas_nama' => $request->atas_nama,
            'pelapak_id' => $konsumen_id
        ]);

        if ($simpanRekening) {
            return redirect('administrator/rekening');
        }
    }

    public function edit($id)
    {
        $data['rekening'] = Rekening_Pelapak::find($id);
        return view('pelapak/rekening/edit_rekening', $data);
    }

    public function ubah(Request $request, $id)
    {
        $rekening = Rekening_Pelapak::find($id);
        $rekening->nama_bank = $request->nama_bank;
        $rekening->nomor_rekening = $request->nomor_rekening;
        $rekening->atas_nama = $request->atas_nama;

        $ubah = $rekening->save();

        if ($ubah) {
            return redirect('administrator/rekening');
        }
    }

    public function hapus($id)
    {
        $hapusRekening = Rekening_Pelapak::where('id_rekening', $id)->delete();

        if ($hapusRekening) {
            return redirect('administrator/rekening');
        }
    }
}
