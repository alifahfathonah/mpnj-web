<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\RegistrasiConfirm;
use App\Models\Konsumen;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class KonsumenWebController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->except('token'), [
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'nomor_hp' => 'required|min:12|numeric|unique:users',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('registerError', 'Register Error. Pastikan data anda sudah benar')
                ->withInput()
                ->withErrors($validator);
        } else {
            $simpan = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'nomor_hp' => $request->nomor_hp,
                'email' => $request->email,
                'role' => 'konsumen'
            ]);

            if ($simpan) {
                $credential = $request->only('username','password');
                if (Auth::attempt($credential)) {
//                    Mail::to($request->email)->send(new RegistrasiConfirm($simpan->id_konsumen));
                    $request->session()->put('role', Auth::user()->role);
                }
                return redirect('/');
            }
        }
    }

    public function kotaByProvinsiId($id)
    {
        $request = $this->client->get('https://api.rajaongkir.com/starter/city?province='.$id, [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $kota = json_decode($request, false);
        // print_r($kota);
        return response()->json($kota, 200);
    }
}
