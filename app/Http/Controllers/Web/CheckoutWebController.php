<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Foto_Produk;
use App\Models\Rekening_Admin;
use App\Models\Keranjang;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CheckoutWebController extends Controller
{
    public function index(Request $request)
    {
        $id_keranjang = $request->id_keranjang;
        $count = json_decode($id_keranjang[0], true);
        if (count($count) == 0) return redirect()->back();
        $reset = Keranjang::whereIn('id_keranjang', json_decode($id_keranjang[0], true))->update([
            'kurir' => null,
            'ongkir' => 0,
            'etd' => null,
            'service' => null
        ]);

        $keranjang = Keranjang::with(['produk', 'user', 'user.alamat_fix', 'user.alamat'])
            ->where('user_id', Auth::id())
            ->whereIn('id_keranjang', json_decode($id_keranjang[0], true))
            ->get()
            ->groupBy('produk.user.nama_toko');

        //        if ($keranjang->count() == 0) {
        //            return redirect('keranjang');
        //        }

        $data['data_keranjang'] = collect();
        $total_berat = 0;
        $data['pembeli'] = [];
        $data['ongkir'] = 0;
        $data['total'] = 0;

        foreach ($keranjang as $key => $value) {
            $item = collect();
            foreach ($value as $val) {
                $data['total'] += ($val->harga_jual - ($val->produk->diskon / 100 * $val->harga_jual)) * $val->jumlah;
                $data['ongkir'] += $val->ongkir;
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
                    'foto' => $val->produk->foto_produk[0]->foto_produk
                ]);
                $total_berat += $val->produk->berat;
            }

            $data['data_keranjang']->push([
                'id_toko' => $keranjang[$key][0]->produk->user->id_user,
                'nama_toko' => $key,
                'alamat' => $keranjang[$key][0]->produk->user->alamatToko,
                'total_berat' => $total_berat,
                'kurir' => $keranjang[$key][0]->kurir,
                'service' => $keranjang[$key][0]->service,
                'ongkir' => $keranjang[$key][0]->ongkir,
                'etd' => $keranjang[$key][0]->etd,
                'item' => $item,
            ]);
            $data['pembeli'] = $keranjang[$key][0]->user;
            $total_berat = 0;
        }

        return view('web/web_checkout', $data, ['id_keranjang' => json_decode($id_keranjang[0], true)]);
    }

    public function simpanTransaksi(Request $request)
    {
        DB::beginTransaction();
        try {
            $trx = [
                'kode_transaksi' => time(),
                'user_id' => Auth::id(),
                'total_bayar' => $request->totalBayar,
                'batas_transaksi' => date('Y-m-d H:i:s', strtotime(' + 1 days')),
                'to' => Auth::user()->alamat_fix->getAlamatLengkapAttribute()
            ];
            $simpanTrx = Transaksi::create($trx);
            $keranjang = Keranjang::whereIn('id_keranjang', json_decode($request->id_keranjang, true))->get();
            foreach ($keranjang as $k) {
                $trxDetail = [
                    'transaksi_id' => $simpanTrx->id_transaksi,
                    'produk_id' => $k->produk_id,
                    'jumlah' => $k->jumlah,
                    'harga_jual' => $k->harga_jual,
                    'diskon' => $k->produk->diskon,
                    'kurir' => $k->kurir,
                    'service' => $k->service,
                    'ongkir' => $k->ongkir,
                    'etd' => $k->etd,
                    'sub_total' => $k->jumlah * $k->harga_jual + $k->ongkir,
                    'user_id' => $k->produk->user_id
                ];

                Transaksi_Detail::create($trxDetail);
            }
            Keranjang::whereIn('id_keranjang', json_decode($request->id_keranjang, true))->delete();
            DB::commit();
            return response()->json($simpanTrx, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public function sukses($kodeTrx)
    {
        $data['order_sukses'] = Transaksi::where('kode_transaksi', $kodeTrx)->first();
        if ($data['order_sukses'] == null) {
            return redirect('pesanan')->with('trxNull', 'Kode transaksi tidak ditemukan');
        }
        $data['order_detail'] = Transaksi_Detail::where('transaksi_id', $data['order_sukses']->id_transaksi)->get();
        $data['order_total'] =  $data['order_detail']->sum("sub_total");
        $data['order_ongkir'] =  $data['order_detail']->sum("ongkir");
        $data['rekening_admin'] = Bank::with('rekening_admin')->get();
        return view('web/web_checkout_sukses', $data);
    }

    public function batal(Request $request)
    {
        $batal = keranjang::where('user_id', Auth::id())->update(['status' => 'N']);
        if ($batal) {
            return redirect(URL::to('keranjang'));
        }
    }

    public function simpanKurir(Request $request)
    {
        $data = [
            'kurir' => $request->kurir,
            'service' => $request->service,
            'ongkir' => $request->ongkir,
            'etd' => $request->etd
        ];

        $id_keranjang = $request->id_keranjang;

        $update = Keranjang::where('user_id', Auth::id())
            ->whereIn('id_keranjang', $id_keranjang)
            ->update($data);

        return $update;
    }
}
