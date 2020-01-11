<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukCollection;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Repositories\ProdukRepository;
use App\User;

class ProdukController extends Controller
{
<<<<<<< HEAD

    Public function SemuaProduk()
    {
        return new ProdukCollection(Produk::get());
    }
    public function DetailProduk($id)
    {
        return new ProdukCollection(Produk::where('id_produk', $id)->get());
=======
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
>>>>>>> d30a528be2c70dfccc9acc5f45664fca90be5577
    }
}
