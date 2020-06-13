<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Foto_Produk;
use App\Repositories\ProdukRepository;
use App\User;
use File;

class ApiProdukController extends Controller
{
    private $produkRepository;

    public function __construct(ProdukRepository $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function index(Request $request)
    {
        $nama = $request->query('cari');
        $produks = $this->produkRepository->all($nama);
        return $produks;
    }

    public function diskonProduk()
    {
        $produks = $this->produkRepository->produkDiskon();
        return $produks;
    }

    public function larisProduk()
    {
        $produks = $this->produkRepository->produkLaris();
        return $produks;
    }

    public function getDetail($id_produk)
    {
        $data = Produk::where('id_produk', $id_produk)->get();
        if (count($data) > 0) {
            $produk = $this->produkRepository->findById($id_produk);
            $res['data'] = $produk;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        };
    }

    public function create(request $request)
    {
        $produk = new Produk;
        $produk->pelapak_id = "1";
        $produk->nama_produk = $request->nama_produk;
        $produk->slug = $request->nama_produk;
        $produk->satuan = $request->satuan;
        $produk->kategori_produk_id = $request->kategori_produk_id;
        $produk->berat = $request->berat;
        $produk->keterangan = $request->keterangan;
        $produk->harga_modal = $request->harga_modal;
        $produk->harga_jual = $request->harga_jual;
        $produk->diskon = $request->diskon;
        $produk->stok = $request->stok;

        $file = $request->file('foto');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move('assets/foto_produk', $name);

        if ($produk->save()) {

            $foto = new Foto_Produk;
            $foto->foto_produk = $name;
            $foto->produk_id = $produk->id_produk;
            $foto->save();

            $res['pesan'] = "Tambah Data Produk Sukses!";
            $res['data'] = [$produk, $foto];

            return response()->json($res, 201);
        } else {
            $res2['pesan'] = "Tambah Data produk Gagal!";
            return response()->json($res2);
        }
    }
}
