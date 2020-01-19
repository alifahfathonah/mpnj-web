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

    public function index()
    {
        $produks = $this->produkRepository->all();
        return $produks;
    }

    public function getDetail($id_produk)
    {
        $produks = $this->produkRepository->findById($id_produk);
        return $produks;
    }

    public function create(request $request)
    {
        $produk = new Produk;
        $produk->pelapak_id = "1";
        $produk->nama_produk = $request->nama_produk;
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

        $produk->save();

        $foto = new Foto_Produk;
        $foto->foto_produk = $name;
        $foto->produk_id = $produk->id_produk;

        $foto->save();
    }

}
