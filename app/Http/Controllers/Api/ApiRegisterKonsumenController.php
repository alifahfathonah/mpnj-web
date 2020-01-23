<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use Illuminate\Http\Request;

class ApiRegisterKonsumenController extends Controller
{
    public function create(request $request)
    {
        $konsumen = new Konsumen;
        $konsumen->nama_lengkap = $request->nama_lengkap;
        $konsumen->username = $request->username;
        $konsumen->password = $request->password;
        $konsumen->provinsi_id = $request->provinsi_id;
        $konsumen->city_id = $request->city_id;
        $konsumen->alamat = $request->alamat;
        $konsumen->kode_pos = $request->kode_pos;
        $konsumen->nomor_hp = $request->nomor_hp;
        $konsumen->email = $request->email;
        $konsumen->status = $request->status;

        if($konsumen->save()){
            $res ['pesan'] = "Sukses!";
            $res ['data'] = [$konsumen];

            return response()->json($res);
        }else{
            $res2 ['pesan'] = "Gagal!";
            $res2 ['data'] = [];
            
            return response()->json($res2);
        }
    }

    public function update(Request $request, $kosumenId)
    {
        $konsumen = Konsumen::find($kosumenId);

        $konsumen->nama_lengkap = $request->nama_lengkap;
        $konsumen->username = $request->username;
        $konsumen->password = $request->password;
        $konsumen->provinsi_id = $request->provinsi_id;
        $konsumen->city_id = $request->city_id;
        $konsumen->alamat = $request->alamat;
        $konsumen->kode_pos = $request->kode_pos;
        $konsumen->nomor_hp = $request->nomor_hp;
        $konsumen->email = $request->email;
        $konsumen->status = $request->status;
        
        if($konsumen->save()){
            $res ['pesan'] = "Sukses!";
            $res ['data'] = [$konsumen];

            return response()->json($res);
        }else{
            $res2 ['pesan'] = "Gagal!";
            $res2 ['data'] = [];
            
            return response()->json($res2);
        }
    }
}
