<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Konsumen;
use Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ApiLoginController extends Controller
{

    use AuthenticatesUsers;
    
    public function __construct()
    {
        $this->middleware('guest')->except('keluar');
        $this->middleware('guest:konsumen')->except('keluar');
    }


        public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('konsumen')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $code_token = Str::random(64);
            $konsumen = Konsumen::where('username',$request->username)->first();
            $token = ['remember_token' => $code_token];
            $token = Konsumen::where('username',$request->username)->update($token);

            return response()->json([
                'pesan' => 'Login Sukses!',
                'token' => $code_token,
                'nama_lengkap' => $konsumen->nama_lengkap,
                'nomor_hp' => $konsumen->nomor_hp,
                'email' => $konsumen->email,
                'foto' => $konsumen->foto_profil,
                'id_konsumen' => $konsumen->id_konsumen
                ], 200);
        }

        return response()->json(['pesan' => 'Login Salah Bro, Santuyy'], 401);
    }

    public function keluar(Request $request)
    {

            $token = ['remember_token' => null ];
            $konsumen = Konsumen::where('id_konsumen',$request->id_konsumen)->update($token);

        return response()->json(['pesan' => 'Berhasil Keluar!'], 200);
    }

}
