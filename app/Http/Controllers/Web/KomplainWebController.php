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
        $data['komplain'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->where('konsumen_id', Auth::id())->get();
        $data['komplain_respon'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->where([['konsumen_id', '=', Auth::id()], ['status', '=', 'Butuh Direspon']])->get();
        $data['komplain_dibaca'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->where([['konsumen_id', '=', Auth::id()], ['status', '=', 'Sudah Dibaca']])->get();
        $data['komplain_selesai'] = Complain::with('transaksi', 'produk', 'produk.foto_produk', 'user')->where([['konsumen_id', '=', Auth::id()], ['status', '=', 'Selesai']])->get();
        return view('web/web_profile', $data);
        return $data;
    }

    public function pengajuan(Request $request)
    {
        $id = $request->query('id_trk');
        $inv = $request->query('kd_inv');
        $data['komplain'] = Transaksi::with(['transaksi_detail' => function ($status) use ($inv) {
            $status->with('produk', 'user')->when(!is_null($inv), function ($query) use ($inv) {
                $query->where('kode_invoice', $inv);
            });
        }])->where('id_transaksi', $id)->first();
        return view('web/web_profile', $data);
        return $data;
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
            'konsumen_id' =>  Auth::id(),
            'transaksi_id' => $request->id_transaksi,
            'kode_invoice' => $request->kode_invoice,
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

    public function view($id_komplain)
    {
        $data['komplain'] = Complain::with(['transaksi', 'user', 'produk', 'produk.foto_produk'])->where('id_complain', $id_komplain)->first();
        return view('web/web_profile', $data);
        return $data;
    }

    public function status($id_complain)
    {
        $find = Complain::where('id_complain', $id_complain)->update(['status' => 'Selesai']);
        if ($find) {
            return redirect()->back();
        }
    }
}
