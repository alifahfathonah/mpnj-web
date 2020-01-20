<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function getDetail($id_pelapak)
    {
        $data = Pelapak::where('id_pelapak',$id_pelapak)->get();
        if (count($data) > 0){
            $pelapaks = $this->pelapakRepository->findById($id_pelapak);
            $res ['pesan'] = "Sukses!";
            $res ['data'] = $pelapaks;
            return response()->json($res);
        }else{
            $res ['pesan'] = "Gagal!";
            $res ['data'] = [];
            return response()->json($res);
        }
    }
}
