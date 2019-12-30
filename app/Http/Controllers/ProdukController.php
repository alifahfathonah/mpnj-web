<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data['produk'] = Produk::where('pelapak_id', 1)->get();
        return view('pelapak/produk/data_produk', $data);
    }
}
