<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class KomplainWebController extends Controller
{
    public function index()
    {
        $data['komplain'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->get();
        $data['komplain_respon'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->where('status', 'Butuh Direspon')->get();
        $data['komplain_dibaca'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->where('status', 'Sudah Dibaca')->get();
        $data['komplain_selesai'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->where('status', 'Selesai')->get();
        return view('web/web_profile', $data);
        return $data;
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
            'produk_id' => $request->id_produk,
            'komplain' => $request->komplain,
            'deskripsi' => $request->deskripsi,
            'foto_komplain' => $name,
            'konsumen_id' =>  Auth::id()
        ]);

        if ($simpanKomplain) {
            $folder = 'assets/foto_komplain';
            $foto_komplain->move($folder, $name);
            return redirect()->to('/komplain');
        }
    }
}
