<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukWebController extends Controller
{
    public function index()
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori'])->get();
        return view('web/web_home', $data);
    }

    public function produkId($id)
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori', 'pelapak'])->where('id_produk', $id)->first();
        return view('web/web_produk_detail', $data);
    }
}
