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

    public function getDetail(Pelapak $id_pelapak)
    {
        return new PelapakResource($id_pelapak);
    }

    public function create(request $request)
    {
            $pelapak = new Pelapak;
            $pelapak->username = $request->username;
            $pelapak->password = $request->password;
            $pelapak->status_official = $request->status_official;
            $pelapak->nama_toko = $request->nama_toko;
            $pelapak->alamat_toko = $request->alamat_toko;
            $pelapak->provinsi_id = $request->provinsi_id;
            $pelapak->city_id = $request->city_id;
            $pelapak->alamat = $request->alamat;
            $pelapak->kode_pos = $request->kode_pos;
            $pelapak->nomor_hp = $request->nomor_hp;
            $pelapak->email = $request->email;
            $pelapak->rating = $request->rating;
            $pelapak->saldo = $request->saldo;
            $pelapak->status = $request->status;

            if($pelapak->save()){
                $res ['pesan'] = "Sukses!";
                $res ['data'] = $pelapak;

                return response()->json($res);
            }else{
                $res2 ['pesan'] = "gagal!";
                $res2 ['data'] = $pelapak;

                return response()->json($res2);
            }
    }
}
