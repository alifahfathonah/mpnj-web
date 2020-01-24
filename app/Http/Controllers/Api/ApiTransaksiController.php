<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TransaksiRepository;
use Illuminate\Http\Request;

class ApiTransaksiController extends Controller
{
    private $transaksiRepository;

    public function __construct(TransaksiRepository $transaksiRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function index()
    {
        $transaksi = $this->transaksiRepository->all();
        return $transaksi;
    }
}
