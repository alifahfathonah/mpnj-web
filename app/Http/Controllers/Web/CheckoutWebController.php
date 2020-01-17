<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutWebController extends Controller
{
    public function index(Request $request)
    {
        $konsumen_id = $request->session()->get('id_konsumen', 0);
        // $data['order'] = DB::table('keranjang')
        //                 ->select('pelapak.nama_toko','produk.id_produk','konsumen.id_konsumen','keranjang.konsumen_id','keranjang.produk_id','pelapak.id_pelapak','produk.pelapak_id')
        //                 ->leftJoin('produk', 'produk.id_produk', '=', 'keranjang.produk_id')
        //                 ->leftJoin('pelapak', 'produk.pelapak_id', '=', 'pelapak.id_pelapak')
        //                 ->leftJoin('konsumen', 'konsumen.id_konsumen', '=', 'keranjang.konsumen_id')
        //                 ->where('keranjang.konsumen_id', 1)
        //                 ->where('keranjang.status', 'Y')
        //                 ->get()
        //                 ->groupBy('keranjang.konsumen_id');
        $data['order'] = Keranjang::with(['produk', 'konsumen'])
                        ->where('konsumen_id', $konsumen_id)
                        ->where('status', 'Y')
                        ->get()
                        ->groupBy('produk.pelapak.nama_toko');
        $data['total'] = Keranjang::where('konsumen_id', $konsumen_id)
                        ->where('status', 'Y')
                        ->sum(DB::raw('jumlah * harga_jual'));
        $data['berat'] = DB::table("keranjang")
                        ->select(DB::raw("SUM(produk.berat * keranjang.jumlah) as total_berat"))
                        ->leftjoin("produk","keranjang.produk_id","=","produk.id_produk")->groupBy('produk.pelapak_id')
                        ->get();

        return view('web/web_checkout', $data);
    }
    
    public function simpanTransaksi(Request $request)
    {
	    $konsumen_id = $request->session()->get('id_konsumen', 0);
    	$simpanTrx = Transaksi::create([
    		'konsumen_id' => $konsumen_id,
		    'kode_transaksi' => 'xosdk',
		    'waktu_transaksi' => date('Y-m-d H:i:s'),
		    'total_bayar' => $request->totalBayar
	    ]);
    	if ($simpanTrx) {
    		foreach ($request->trxDetail as $detail) {
    			$detail['transaksi_id'] = $simpanTrx->id_transaksi;
    			Transaksi_Detail::create($detail);
		    }
		    return response()->json('sukses',200);
	    }
    }
}
