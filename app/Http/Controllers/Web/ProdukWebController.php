<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukWebController extends Controller
{
    public function index()
    {
        $data['produk'] = Produk::with('foto_produk')->get();
        return view('web/web_produk', $data);
    }
}
