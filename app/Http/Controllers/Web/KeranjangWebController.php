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
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;


        $keranjang = Keranjang::with(['produk', 'pembeli', 'pembeli.alamat_fix'])
            ->where('pembeli_id', $konsumen_id)
            ->where('pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
            ->where('status', 'N')
            ->get()
            ->groupBy('produk.pelapak.nama_toko');
        // $data['total'] = DB::table('keranjang')->join('produk', 'keranjang.produk_id', '=', 'produk.id_produk')->where('keranjang.konsumen_id', $konsumen_id)->sum('produk.harga_jual');
        //        $data['total'] = Keranjang::where('pembeli_id', $konsumen_id)
        //	                    ->where('status', 'N')
        //	                    ->sum(DB::raw('jumlah * harga_jual'));

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
                    'slug' => $val->produk->slug,
                    'kategori' => $val->produk->kategori->nama_kategori,
                    'foto' => asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk)
                ]);
            }

            $data['data_keranjang']->push([
                'id_toko' => $keranjang[$key][0]->produk->pelapak->id_pelapak,
                'nama_toko' => $key,
                'alamat' => $keranjang[$key][0]->produk->pelapak->alamat_fix,
                'item' => $item
            ]);
            $data['pembeli'] = $keranjang[$key][0]->pembeli;
        }
        return view('web/web_keranjang', $data);
    }

    public function simpan(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $simpan = Keranjang::create([
            'produk_id' => $request->id_produk,
            'pembeli_id' => $konsumen_id,
            'pembeli_type' => $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak',
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
