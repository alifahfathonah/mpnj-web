<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangWebController extends Controller
{
    public function index(Request $request)
    {
        $konsumen_id = $request->session()->get('id_konsumen', 0);
        $data['keranjang'] = Keranjang::with(['produk', 'konsumen'])
	                        ->where('konsumen_id', $konsumen_id)
	                        ->where('status', 'N')
	                        ->get()
	                        ->groupBy('produk.pelapak.nama_toko');
        // $data['total'] = DB::table('keranjang')->join('produk', 'keranjang.produk_id', '=', 'produk.id_produk')->where('keranjang.konsumen_id', $konsumen_id)->sum('produk.harga_jual');
        $data['total'] = Keranjang::where('konsumen_id', $konsumen_id)
	                    ->where('status', 'N')
	                    ->sum(DB::raw('jumlah * harga_jual'));
        return view('web/web_keranjang', $data);
    }

    public function simpan(Request $request)
    {
        $simpan = Keranjang::create([
            'produk_id' => $request->id_produk,
            'konsumen_id' => $request->session()->get('id_konsumen', 0),
	        'jumlah' => 1,
	        'harga_jual' => $request->harga_jual
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
        $sum = Keranjang::whereIn('id_keranjang', $request->id_keranjang)->sum(DB::raw('jumlah * harga_jual'));
        return $sum;
    }

    public function ambilHarga(Request $request)
    {
        $harga = Produk::select('harga_jual')->where('id_produk', $request->produk_id)->first();
        return $harga->harga_jual;
    }

    public function updateJumlah(Request $request)
    {
        $keranjang = Keranjang::find($request->id_keranjang);
        $keranjang->jumlah = $request->qty;
        $keranjang->save();

        return $keranjang->harga_jual;
    }

    public function go_checkout(Request $request)
    {
        $id_keranjang = $request->id_keranjang;

        $update = Keranjang::whereIn('id_keranjang', $id_keranjang)->update(['status' => 'Y']);

        if ($update) {
            return $update;
        }
    }
}
