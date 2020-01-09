<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukCollection;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\User;

class ProdukController extends Controller
{

    Public function SemuaProduk()
    {
        return new ProdukCollection(Produk::get());
    }
    public function DetailProduk($id)
    {
        return new ProdukCollection(Produk::where('id_produk', $id)->get());
    }
}
