<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use App\Repositories\TransaksiRepository;
use Illuminate\Http\Request;
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

    public function simpan(Request $request)
    {
        $id = Session::get('id_user');
        //$id = Session::get('id');
        //$konsumen_id = $request->user($role)->$id;

        $data = array(
            'user_id' => $request->id_user,
            'kode_transaksi' => time(),
            'waktu_transaksi' => date('Y-m-d H:i:s'),
            'total_bayar' => $request->total_bayar
        );

        $transaksi = $this->transaksiRepository->create($data);
        if ($transaksi) {
            // foreach ($request->trxDetail as $detail) {
            //     $detail['transaksi_id'] = $transaksi->id_transaksi;
            //     Transaksi_Detail::create($detail);
            // }
            return response()->json(
                [
                    'kode_transaksi' => $transaksi->kode_transaksi,
                    'total_bayar' => $transaksi->total_bayar
                ],
                200
            );
        } else {
            return response()->json('gagal', 400);
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

        $update = Keranjang::whereI('id_keranjang', $id_keranjang)
            ->update($data);

        return $update;
    }
}
