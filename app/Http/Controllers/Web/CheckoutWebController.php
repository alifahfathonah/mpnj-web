<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Foto_Produk;
use App\Models\Keranjang;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutWebController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkUserLogin');
    }

    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;
        // $data['order'] = DB::table('keranjang')
        //                 ->select('pelapak.nama_toko','produk.id_produk','konsumen.id_konsumen','keranjang.konsumen_id','keranjang.produk_id','pelapak.id_pelapak','produk.pelapak_id')
        //                 ->leftJoin('produk', 'produk.id_produk', '=', 'keranjang.produk_id')
        //                 ->leftJoin('pelapak', 'produk.pelapak_id', '=', 'pelapak.id_pelapak')
        //                 ->leftJoin('konsumen', 'konsumen.id_konsumen', '=', 'keranjang.konsumen_id')
        //                 ->where('keranjang.konsumen_id', 1)
        //                 ->where('keranjang.status', 'Y')
        //                 ->get()
        //                 ->groupBy('keranjang.konsumen_id');
        $data['order'] = Keranjang::with(['produk', 'pembeli', 'pembeli.alamat_fix', 'pembeli.daftar_alamat'])
            ->where('pembeli_id', $konsumen_id)
            ->where('pembeli_type', $role == 'konsumen' ? Konsumen::class : Pelapak::class)
            ->where('status', 'Y')
            ->get()
            ->groupBy('produk.pelapak.nama_toko');
        //        $data['total'] = Keranjang::where('pembeli_id', $konsumen_id)
        //                        ->where('status', 'Y')
        //                        ->sum(DB::raw('jumlah * harga_jual'));
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
            Keranjang::whereIn('id_keranjang', $request->idKeranjang)->delete();
            return response()->json($simpanTrx, 200);
        }
    }

    public function sukses($kodeTrx)
    {
        $data['order_sukses'] = Transaksi::where('kode_transaksi', $kodeTrx)->first();
        return view('web/web_checkout_sukses', $data);
    }
}
