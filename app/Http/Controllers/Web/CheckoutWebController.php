<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Foto_Produk;
use App\Models\Rekening_Admin;
use App\Models\Keranjang;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CheckoutWebController extends Controller
{
    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;
        $keranjang = Keranjang::with(['produk', 'pembeli', 'pembeli.alamat_fix', 'pembeli.daftar_alamat'])
            ->where('pembeli_id', $konsumen_id)
            ->where('pembeli_type', $role == 'konsumen' ? Konsumen::class : Pelapak::class)
            ->where('status', 'Y')
            ->get()
            ->groupBy('produk.pelapak.nama_toko');
        $data['data_keranjang'] = collect();
        $total_berat = 0;
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
                    'berat' => $val->produk->berat,
                    'stok' => $val->produk->stok,
                    'slug' => $val->produk->slug,
                    'terjual' => $val->produk->terjual,
                    'kategori' => $val->produk->kategori->nama_kategori,
                    'foto' => asset('assets/foto_produk/' . $val->produk->foto_produk[0]->foto_produk)
                ]);
                $total_berat += $val->produk->berat;
            }

            $data['data_keranjang']->push([
                'id_toko' => $keranjang[$key][0]->produk->pelapak->id_pelapak,
                'nama_toko' => $key,
                'alamat' => $keranjang[$key][0]->produk->pelapak->alamat_fix,
                'total_berat' => $total_berat,
                'item' => $item,
            ]);
            $data['pembeli'] = $keranjang[$key][0]->pembeli;
            $total_berat = 0;
        }

        return view('web/web_checkout', $data);
    }

    public function simpanTransaksi(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $simpanTrx = Transaksi::create([
            'pembeli_id' => $konsumen_id,
            'pembeli_type' => $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak',
            'kode_transaksi' => time(),
            'waktu_transaksi' => date('Y-m-d H:i:s'),
            'total_bayar' => $request->totalBayar
        ]);
        if ($simpanTrx) {
            foreach ($request->trxDetail as $detail) {
                //buat trigger ketika data masuk ke transaksi detail untuk mengurangi stok produk dan memperbarui field terjual
                $detail['transaksi_id'] = $simpanTrx->id_transaksi;
                Transaksi_Detail::create($detail);
            }
            foreach ($request->prosesData as $produk) {
                foreach ($request->idp as $i) {
                    Produk::where('id_produk', $i)->update($produk);
                }
            }
            Keranjang::whereIn('id_keranjang', $request->idKeranjang)->delete();
            return response()->json($simpanTrx, 200);
        }
    }

    public function sukses($kodeTrx)
    {
        $data['order_sukses'] = Transaksi::where('kode_transaksi', $kodeTrx)->first();
        $data['order_detail'] = Transaksi_Detail::where('transaksi_id', $data['order_sukses']->id_transaksi)->get();
        $data['order_total'] =  $data['order_detail']->sum("sub_total");
        $data['order_ongkir'] =  $data['order_detail']->sum("ongkir");
        $data['rekening_admin'] = Rekening_Admin::with('bank')->get();
        return view('web/web_checkout_sukses', $data);
    }


    public function batal(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $batal = keranjang::where('pembeli_id', $konsumen_id)->where('pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')->update(['status' => 'N']);
            if ($batal) {
                return redirect(URL::to('keranjang'));
            }
    }

}
