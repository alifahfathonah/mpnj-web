<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PelapakRepository;

class PelapakController extends Controller
{
    private $pelapakRepository;

    public function __construct(ProdukRepository $produkRepository)
    {
        $this->pelapakRepository = $pelapakRepository;
    }

    public function index()
    {
        $pelapaks = $this->pelapakRepository->all();
        return $pelapaks;
    }
}
