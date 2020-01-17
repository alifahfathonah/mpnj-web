<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\KeranjangRepository;
use Illuminate\Http\Request;

class ApiKeranjangController extends Controller
{
    private $keranjangRepository;

    public function __construct(KeranjangRepository $keranjangRepository)
    {
        $this->keranjangRepository = $keranjangRepository;
    }

    public function index()
    {
        $keranjangs = $this->keranjangRepository->all();
        return $keranjangs;
    }

    public function simpan(Request $request)
    {
        $data = array(
            'produk_id' => $request->produk_id,
            'konsumen_id' => $request->konsumen_id,
            'status' => $request->status,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual
        );
        $keranjangs = $this->keranjangRepository->create($data);
        if ($keranjangs) {
            return response()->json('sukses', 200);
        } else {
            return response()->json('gagal', 400);
        }
    }

    // public function create(array $data)
    // {
    //     return $this->keranjangRepository->create($data);
    // }
}
