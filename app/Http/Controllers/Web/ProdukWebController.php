<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kategori_Produk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukWebController extends Controller
{
    public function index()
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori', 'pelapak'])->get();
        $data['kategori'] = Kategori_Produk::Select('id_kategori_produk', 'nama_kategori')->get();
        return view('web/web_home', $data);
    }

    public function produk()
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori', 'pelapak'])->paginate(9);
        $data['kategori'] = Kategori_Produk::Select('id_kategori_produk', 'nama_kategori')->get();
        return view('web/web_produk', $data);
    }

    public function produkId($id)
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori', 'pelapak'])->where('id_produk', $id)->first();
        return view('web/web_produk_detail', $data);
    }
}
