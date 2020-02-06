<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\Hash;
use DB;

class ApiKonsumenController extends Controller
{
     public function lupa_password(Request $request, $kosumenId)
    {
        
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
