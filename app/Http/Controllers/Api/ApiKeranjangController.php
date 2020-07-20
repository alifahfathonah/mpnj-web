<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Repositories\KeranjangRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ApiKeranjangController extends Controller
{
    private $keranjangRepository;

    public function __construct(KeranjangRepository $keranjangRepository)
    {
        $this->keranjangRepository = $keranjangRepository;
    }

    public function index(Request $request)
    {
        $id = $request->query('id');
        //        $keranjangs = $this->keranjangRepository->all($role, $id);
        $keranjang = Keranjang::orderBy('id_keranjang')
            ->with('produk')
            ->where('user_id', $id)
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
                    'terjual' => $val->produk->terjual,
                    'kategori' => [
                        'id_kategori' => $val->produk->kategori->id_kategori_produk,
                        'nama_kategori' => $val->produk->kategori->nama_kategori
                    ],
                    'keterangan' => $val->produk->keterangan,
                    'foto' => $val->produk->foto_produk[0]->foto_produk
                ]);
            }

            $data['data_keranjang']->push([
                'id_toko' => $keranjang[$key][0]->produk->user->id_user,
                'nama_toko' => $key,
                'item' => $item
            ]);
            $data['pembeli'] = $keranjang[$key][0]->user;
        }
        return response()->json($data, 200);
    }

    public function simpan(Request $request)
    {
        $cekExistData = Keranjang::where('produk_id', $request->produk_id)
            ->where('user_id', $request->pembeli_id)
            ->first();

        if ($cekExistData != '') {
            $cekExistData->jumlah += $request->jumlah;
            $update = $cekExistData->save();
            if ($update) {
                return response()->json([
                    'pesan' => 'sukses',
                    'data' => $cekExistData
                ], 200);
            } else {
                return response()->json('gagal', 400);
            }
        }

        $data = array(
            'produk_id' => $request->produk_id,
            'user_id' => $request->pembeli_id,
            'status' => 'N',
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual
        );
        $keranjangs = $this->keranjangRepository->create($data);
        if ($keranjangs) {
            return response()->json([
                'pesan' => 'sukses',
                'data' => $data
            ], 200);
        } else {
            return response()->json('gagal', 400);
        }
    }

    public function hapus($id)
    {
        $hapus = $this->keranjangRepository->delete($id);
        if ($hapus) {
            return response()->json([
                'pesan' => 'sukses',
                'data' => $hapus
            ], 200);
        } else {
            return response()->json([
                'pesan' => 'gagal'
            ], 400);
        }
    }

    public function gantiJumlah(Request $request, $id)
    {
        $gantiJumlah = $request->jumlah;
        $ganti = $this->keranjangRepository->updateJumlah($gantiJumlah, $id);
        if ($ganti) {
            return response()->json([
                'jumlah' => $ganti
            ], 200);
        } else {
            return response()->json('gagal', 400);
        }
    }

    public function cekHarga(Request $request)
    {
        $cekHarga = $request->id_keranjang;
        $cek = $this->keranjangRepository->checkPrice($cekHarga, 'id_keranjang');
        if ($cekHarga) {
            return response()->json([
                'total' => $cek
            ], 200);
        } else {
            return response()->json('gagal', 400);
        }
    }

    public function keCheckOut(Request $request, $id)
    {
        $idGanti = $request->id_keranjang;
        $gantiStatus = $this->keranjangRepository->goCheckOut($idGanti, $id);
        if ($gantiStatus) {
            return response()->json($gantiStatus, 200);
        } else {
            return response()->json('gagal', 400);
        }
    }
}
