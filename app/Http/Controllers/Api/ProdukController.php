<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Repositories\ProdukRepository;
use App\User;

class ProdukController extends Controller
{
    private $produkRepository;

    public function __construct(ProdukRepository $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function index()
    {
        $produks = $this->produkRepository->all();
        return $produks;
    }

    public function getDetail($id_produk)
    {
        $produks = $this->produkRepository->findById($id_produk);
        return $produks;
    }
}
