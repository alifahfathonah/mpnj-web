<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Konsumen;
use Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ApiLoginController extends Controller
{


        public function login(Request $request)
    {
        if (!Auth::guard('api')->attempt(['username' => $request->username, 'password' => $request->password])){
            // $konsumen = Auth::api();
            $code_token = Str::random(64);
            $token = ['remember_token' => $code_token];
            $token = Konsumen::where('username',$request->username)->update($token);

            return response()->json(['pesan' => 'Login Sukses!','token' => $code_token], 200);
        }else {
            
        return response()->json(['error' => 'Login Salah Bro, Santuyy'], 401);
            
        }
    }
}
