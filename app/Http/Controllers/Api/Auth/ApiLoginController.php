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
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class ApiLoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('keluar');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json([
            'pesan' => 'Login Sukses!',
            'id_user' => Auth::user()->id_user,
            'username' => Auth::user()->username,
            'nama_lengkap' => Auth::user()->nama_lengkap,
            'nomor_hp' => Auth::user()->nomor_hp,
            'email' => Auth::user()->email,
            'foto' => Auth::user()->foto_profil,
            'token' => $token
        ]);
    }

    public function keluar(Request $request)
    {
        $keluar = JWTAuth::invalidate(JWTAuth::getToken());
        if ($keluar) {
            return response()->json(['pesan' => 'Berhasil Keluar!'], 200);
        }
    }

}
