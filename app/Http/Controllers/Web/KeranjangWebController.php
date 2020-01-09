<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangWebController extends Controller
{
    public function index(Request $request)
    {
        $konsumen_id = $request->session()->get('id_konsumen', 0);
        $data['keranjang'] = Keranjang::with(['produk', 'konsumen'])->where('konsumen_id', $konsumen_id)->get();
        return view('web/web_keranjang', $data);
    }

    public function simpan(Request $request)
    {
        // $cek = Keranjang::where('produk_id', '=', $request->id_produk)->first();
        // if ($cek != 0) {
        //     $cek->
        // }
        $simpan = Keranjang::create([
            'produk_id' => $request->id_produk,
            'konsumen_id' => $request->session()->get('id_konsumen', 0)
        ]);

        if ($simpan) {
            return redirect('/keranjang');
        }
    }

    public function hapus($id)
    {
        $hapus = Keranjang::where('id_keranjang', $id)->delete();
        if ($hapus) {
            return redirect('/keranjang');
        }
    }
}
