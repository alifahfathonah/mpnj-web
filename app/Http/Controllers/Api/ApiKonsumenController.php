<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;
use App\Models\Konsumen;
use App\Models\Alamat;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use DB;

class ApiKonsumenController extends Controller
{
    protected $client, $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = 'c506cdfc35a33e3d47fb068b799c0630';
    }


    public function profile($id_konsumen)
    {
        $konsumen = Konsumen::with('daftar_alamat')->where('id_konsumen',$id_konsumen)->first(
            ['id_konsumen', 'nama_lengkap', 'username', 'nomor_hp', 'email', 'status', 'alamat_utama', 'status', 'created_at', 'updated_at']
        );

//        return $konsumen->daftar_alamat[0]['id_alamat'];
        foreach ($konsumen->daftar_alamat as $a) {
            if ($a['id_alamat'] == $konsumen['alamat_utama']) {
                $a['status'] = 'utama';
            } else {
                $a['status'] = 'bukan';
            }
        }

        return response()->json([
           'pesan' => 'Sukses!!',
           'data' => $konsumen
        ]);
    }

    public function cek_email($email)
    {
      $konsumen = Konsumen::where('email',$email)->first();
        if($konsumen){    
            $res ['pesan'] = "Sukses!";
            $hasil['id_konsumen'] = $konsumen->id_konsumen;
            $res['data'] = $hasil;
            return response()->json($res);

        }else{
            return response()->json(['pesan' => 'Login Salah Bro, Santuyy'], 401);
        }
    }

     public function lupa_password(Request $request, $kosumenId)
    {
        
        $request = Validator::make(Request::all(),[ 
        'password' => 'required',
    ]);

        $konsumen = Konsumen::find($kosumenId);
        $konsumen->password = Hash::make(Request::get('password'));

        if($request->fails()){
            $res ['pesan'] = "Gagal";
            $res ['response'] = $request->messages();

            return response()->json($res);
        }else{
            $konsumen->save();
            $res2 ['pesan'] = "Sukses!";
            $res2 ['data'] = ["Password Berhasil Diganti"];
            
            return response()->json($res2);
        }
    }

}
