<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PelapakResource;
use App\Models\Pelapak;

use App\Repositories\PelapakRepository;

class ApiPelapakController extends Controller
{
    private $pelapakRepository;

    public function __construct(PelapakRepository $pelapakRepository)
    {
        $this->pelapakRepository = $pelapakRepository;
    }

    public function index()
    {
        $pelapaks = $this->pelapakRepository->all();
        $res ['pesan'] = "Sukses!";
        $res ['data'] = $pelapaks;
        return response()->json($res);
    }

    public function getDetail(Pelapak $ipelapak)
    {

        return new PelapakResource($pelapak);
    }
}
