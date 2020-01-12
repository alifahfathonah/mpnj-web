<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PelapakRepository;

class PelapakController extends Controller
{
    private $pelapakRepository;

    public function __construct(PelapakRepository $pelapakRepository)
    {
        $this->pelapakRepository = $pelapakRepository;
    }

    public function index()
    {
        $pelapaks = $this->pelapakRepository->all();
        return $pelapaks;
    }

    public function getDetail($id_pelapak)
    {
        $pelapaks = $this->pelapakRepository->findById($id_pelapak);
        return $pelapaks;
    }
}
