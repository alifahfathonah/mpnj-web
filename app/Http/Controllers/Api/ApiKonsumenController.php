<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Request;
use App\Models\Konsumen;

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
        
         $konsumen = Konsumen::where('id_konsumen',$id_konsumen)->first();
        if($konsumen){
             $res ['pesan'] = "Sukses!";
             $hasil['id_konsumen'] = $id_konsumen;
             $hasil['nama_lengkap'] = $konsumen->nama_lengkap;
             $request = $this->client->get('https://api.rajaongkir.com/starter/city?id='.$konsumen->city_id.'',[
                'headers' => [
                    'key' => $this->token
                ]
              ])->getBody()->getContents();
            $kota = json_decode($request,false);
            
            $alamat = array();
            $alamat['alamat'] = $konsumen->alamat;
            $alamat['kota'] = $kota->rajaongkir->results->type.' '.$kota->rajaongkir->results->city_name;
            $alamat['provinsi'] = $kota->rajaongkir->results->province;
            $alamat['kode_pos'] = $konsumen->kode_pos;

            $hasil['alamat_utama']  = $alamat;
            
            $hasil['nomer'] = $konsumen->nomor_hp;
            $hasil['email'] = $konsumen->email;

            $res['data'] = $hasil;
            return response()->json($res);

        }else{
            return response()->json(['pesan' => 'Login Salah Bro, Santuyy'], 401);
        }
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
            $res ['pesan'] = "gagal";
            $res ['response'] = $request->messages();

            return response()->json($res);
        }else{
            $konsumen->save();
            $res ['data'] = [$konsumen];
            $res2 ['pesan'] = "Sukses!";
            $res2 ['data'] = [$konsumen];
            
            return response()->json($res2);
        }
    }

}
