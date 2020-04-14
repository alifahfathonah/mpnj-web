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

    public function produk($id)
    {
        $produk = Kategori_Produk::with('produk')->where('id_kategori_produk', $id)->first();
        if ($produk != null) {
            if ($produk->produk->count() > 0) {
                return response()->json($produk, 200);
            } else {
                return response()->json($produk->produk, 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'pesan' => 'data tidak ditemukan'
            ], 404);
        }
    }
}
