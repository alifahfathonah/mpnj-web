<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Konsumen;

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
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $code_token = Str::random(64);
            $token = ['remember_token' => $code_token];
            $update_token = User::where('username',$request->username)->update($token);

            return response()->json([
                'pesan' => 'Login Sukses!',
                'token' => $code_token,
                'id_user' => Auth::user()->id_user,
                'username' => Auth::user()->username,
                'nama_lengkap' => Auth::user()->nama_lengkap,
                'nomor_hp' => Auth::user()->nomor_hp,
                'email' => Auth::user()->email,
                'foto' => Auth::user()->foto_profil
                ], 200);
        }

        return response()->json(['pesan' => 'Login Salah Bro, Santuyy'], 401);
    }

    public function keluar(Request $request)
    {

            $token = ['remember_token' => null ];
            $update_token = User::where('id_user',$request->id_konsumen)->update($token);
            if ($update_token) {
                return response()->json(['pesan' => 'Berhasil Keluar!'], 200);
            }
    }

}
