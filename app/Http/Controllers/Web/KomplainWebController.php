<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomplainWebController extends Controller
{
    public function index()
    {
        return view('web/web_profile');
    }

    public function pengajuan($kode_transaksi)
    {
        $data['komplain'] = Transaksi::with(['transaksi_detail' => function ($status) {
            $status->where('status_order', 'Telah Sampai')->with('user', 'produk');
        }])->where('kode_transaksi', $kode_transaksi)->first();
        return view('web/web_profile', $data);
        // return $data;
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->except('token'), [
            'foto_komplain' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $foto_komplain = $request->file('foto_komplain');
        $name = uniqid() . '_foto_komplain_' . trim($foto_komplain->getClientOriginalName());

        $simpanKomplain = Complain::create([
            'user_id' => $request->id_user,
            'produk_user' => $request->id_produk,
            'komplain' => $request->komplain,
            'deskripsi' => $request->deskripsi,
            'foto_komplain' => $name
        ]);

        if ($simpanKomplain) {
            $folder = 'assets/foto_komplain';
            $foto_komplain->move($folder, $name);
            return redirect()->to('/komplain');
        }
    }
}
