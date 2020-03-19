<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Foto_Produk;
use App\Models\Keranjang;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Produk;
use App\Models\Rekening_Admin;
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

        $data['order'] = Keranjang::with(['produk', 'pembeli', 'pembeli.alamat_fix', 'pembeli.daftar_alamat'])
            ->where('pembeli_id', $konsumen_id)
            ->where('pembeli_type', $role == 'konsumen' ? Konsumen::class : Pelapak::class)
            ->where('status', 'Y')
            ->get()
            ->groupBy('produk.pelapak.nama_toko');

        $data['berat'] = DB::table("keranjang")
            ->select(DB::raw("SUM(produk.berat * keranjang.jumlah) as total_berat"))
            ->leftjoin("produk", "keranjang.produk_id", "=", "produk.id_produk")->groupBy('produk.pelapak_id')
            ->get();

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
        $data['order_sukses'] = Transaksi::with(['transaksi_detail', 'pembeli'])->where('kode_transaksi', $kodeTrx)->first();
        $data['rekening_admin'] = Rekening_Admin::with(['bank'])->get();
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
