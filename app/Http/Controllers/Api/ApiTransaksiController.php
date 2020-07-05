<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Pengiriman;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use App\Repositories\TransaksiRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApiTransaksiController extends Controller
{
    private $transaksiRepository;

    public function __construct(TransaksiRepository $transaksiRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function index(Request $request)
    {
        $id = $request->query('id');
        $id_keranjang = $request->id_keranjang;

        $keranjang = Keranjang::with(['produk', 'user', 'user.alamat_fix', 'user.alamat'])
            ->where('user_id', $id)
            ->whereIn('id_keranjang', $id_keranjang)
            ->get()
            ->groupBy('produk.user.nama_toko');

        $data['data_keranjang'] = collect();
        $data['pembeli'] = [];
        $data['total'] = 0;

        $total_berat = 0;

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
                    'foto' => $val->produk->foto_produk[0]->foto_produk
                ]);
                $total_berat += $val->produk->berat;
            }

            $data['data_keranjang']->push([
                'id_toko' => $keranjang[$key][0]->produk->user->id_user,
                'nama_toko' => $key,
                'id_kabupaten' => $keranjang[$key][0]->produk->user->alamatToko->city_id,
                'nama_kota' => $keranjang[$key][0]->produk->user->alamatToko->nama_kota,
                'total_berat' => $total_berat,
                'kurir' => $keranjang[$key][0]->kurir,
                'service' => $keranjang[$key][0]->service,
                'ongkir' => $keranjang[$key][0]->ongkir,
                'etd' => $keranjang[$key][0]->etd,
                'item' => $item
            ]);
            $data['pembeli'] = [
                'id_user' => $keranjang[$key][0]->user->id_user,
                'alamat_utama' => $keranjang[$key][0]->user->alamat_fix->getAlamatLengkapAttribute(),
                'id_kecamatan' => $keranjang[$key][0]->user->alamat_fix->kecamatan_id,
            ];
        }
        return response()->json($data, 200);
    }

    public function transaksiDate($kode_trk)
    {
        $data = Transaksi::where('kode_transaksi', $kode_trk)->get();
        if (count($data) > 0) {
            $tgl_trk = $this->transaksiRepository->tglTransaksi($kode_trk);
            $res['data'] = $tgl_trk;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        };
    }

    public function simpan(Request $request)
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
            $keranjang = Keranjang::whereIn('id_keranjang', json_decode($request->id_keranjang, true))->get()->groupby('produk.user_id');
            $latestId = Pengiriman::all()->last();
            $n = 0;
            if (is_null($latestId)) {
                $n = 1;
            } else {
                $n = $latestId->id + 1;
            }
            foreach ($keranjang as $key => $k) {
                foreach ($k as $k) {
                    $trxDetail = [
                        'transaksi_id' => $simpanTrx->id_transaksi,
                        'produk_id' => $k->produk_id,
                        'kode_invoice' => is_null($n) ? 'NJ-1' : 'NJ-'.$n,
                        'jumlah' => $k->jumlah,
                        'harga_jual' => $k->harga_jual,
                        'diskon' => $k->produk->diskon,
                        'kurir' => $k->kurir,
                        'service' => $k->service,
                        'ongkir' => $k->ongkir,
                        'etd' => $k->etd,
                        'sub_total' => $k->produk->diskon == 0 ? $k->jumlah * $k->harga_jual : $k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual),
                        'user_id' => $k->produk->user_id
                    ];
                    Transaksi_Detail::create($trxDetail);
                }
                Pengiriman::create([
                    'kode_invoice' => 'NJ-'.$n,
                    'kurir' => $k->kurir,
                    'service' => $k->service,
                    'ongkir' => $k->ongkir,
                    'etd' => $k->etd,

                ]);
                $n++;
            }

            Keranjang::whereIn('id_keranjang', json_decode($request->id_keranjang, true))->delete();
            DB::commit();
            return response()->json(
                [
                    'kode_transaksi' => $simpanTrx->kode_transaksi,
                    'total_bayar' => $request->total_bayar
                ],
                200
            );
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'pesan' => 'gagal'
            ], 404);
        }
    }

    public function batal(Request $request)
    {
        $id = $request->user_id;

        $batal = Keranjang::where('user_id', $id)->update(['status' => 'N']);
        if ($batal) {
            return response()->json(
                [
                    'pesan' => 'berhasil dibatalkan'
                ],
                200
            );
        } else {
            return response()->json('gagal', 400);
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

        $update = Keranjang::whereIn('id_keranjang', $id_keranjang)
            ->update($data);

        return response()->json([
            'pesan' => 'sukses',
            'status' => 200
        ], 200);
    }
}
