<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori_Produk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ApiKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori_Produk::all();
        return response()->json($kategori, 200);
    }
}
