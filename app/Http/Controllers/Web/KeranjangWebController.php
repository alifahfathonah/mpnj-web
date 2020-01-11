<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangWebController extends Controller
{
    public function index(Request $request)
    {
        $konsumen_id = $request->session()->get('id_konsumen', 0);
        $data['keranjang'] = Keranjang::with(['produk', 'konsumen'])->where('konsumen_id', $konsumen_id)->get()->groupBy('produk.pelapak.nama_toko');
        $data['total'] = DB::table('keranjang')->join('produk', 'keranjang.produk_id', '=', 'produk.id_produk')->where('keranjang.konsumen_id', $konsumen_id)->sum('produk.harga_jual');
        return view('web/web_keranjang', $data);
    }

    public function simpan(Request $request)
    {
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

    public function hitungTotal(Request $request)
    {
        $sum = Produk::whereIn('id_produk', $request->produk_id)->sum('harga_jual');
        return $sum;
    }

    public function ambilHarga(Request $request)
    {
        $harga = Produk::select('harga_jual')->where('id_produk', $request->produk_id)->first();
        return $harga->harga_jual;
    }
}
