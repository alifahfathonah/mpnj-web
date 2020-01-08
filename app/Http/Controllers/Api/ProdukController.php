<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\User;

class ProdukController extends Controller
{
    public function index(Produk $produk)
    {
    return response()->json([
    'success'=>true, 
    'message'=>'string', 
    'data'=>Produk::all()
        ]);
    }
}
