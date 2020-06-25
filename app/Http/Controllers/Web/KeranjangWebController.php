<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KeranjangWebController extends Controller
{

    public function index(Request $request)
    {
        $keranjang = Keranjang::with(['produk', 'user', 'user.alamat_fix'])
            ->where('user_id', Auth::id())
            ->get()
            ->groupBy('produk.user.nama_toko');

        $data['data_keranjang'] = collect();
        $data['pembeli'] = [];
        $data['total'] = 0;

        foreach ($keranjang as $key => $value) {
            $item = collect();
            foreach ($value as $val) {
                $data['total'] += ($val->harga_jual - ($val->produk->diskon / 100 * $val->harga_jual)) * $val->jumlah;
                $item->push([
                    'id_keranjang' => $val->id_keranjang,
                    'jumlah' => $val->jumlah,
                    'harga_jual' => $val->harga_jual,
                    'diskon' => $val->produk->diskon,
                    'id_produk' => $val->produk->id_produk,
                    'nama_produk' => $val->produk->nama_produk,
                    'stok' => $val->produk->stok,
                    'slug' => $val->produk->slug,
                    'kategori' => $val->produk->kategori->nama_kategori,
                    'foto' => $val->produk->foto_produk[0]->foto_produk
                ]);
            }

            $data['data_keranjang']->push([
                'id_toko' => $keranjang[$key][0]->produk->user->id_user,
                'nama_toko' => $key,
                'alamat' => $keranjang[$key][0]->produk->user->alamat_fix,
                'item' => $item
            ]);
            $data['pembeli'] = $keranjang[$key][0]->user;
        }
        return view('web/web_keranjang', $data);
    }

    public function simpan(Request $request)
    {
        $cekExistData = Keranjang::where('produk_id', $request->id_produk)->where('user_id', Auth::id())->first();

        if ($cekExistData != '') {
            $cekExistData->jumlah += $request->jumlah;
            $cekExistData->save();
            return redirect('/keranjang');
        }
        $simpan = Keranjang::create([
            'produk_id' => $request->id_produk,
            'user_id' => Auth::id(),
//            'pembeli_type' => $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak',
            'jumlah' => $request->jumlah,
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
        $sum = Keranjang::with('produk')
            ->whereIn('id_keranjang', $request->id_keranjang)->sum(DB::raw('jumlah * harga_jual'));
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
