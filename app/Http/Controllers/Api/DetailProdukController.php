<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Repositories\ProdukDetailRepository;
use Illuminate\Http\Request;

class DetailProdukController extends Controller
{

    private $produkDetailRepository;

    public function __construct(ProdukDetailRepository $produkDetailRepository)
    {
        $this->produkDetailRepository = $produkDetailRepository;
    }

    public function index()
    {
        $produks = $this->produkDetailRepository->all();
        return $produks;
    }

    public function getDetail($id_produk)
    {
        $produks = $this->produkDetailRepository->findById($id_produk);
        return $produks;
    }
}
