<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\RegistrasiConfirm;
use App\Models\Konsumen;
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
            'username' => 'required|unique:konsumen',
            'password' => 'required',
            'nomor_hp' => 'required|min:12|numeric|unique:konsumen',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('registerError', 'Register Error. Pastikan data anda sudah benar')
                ->withInput()
                ->withErrors($validator);
        } else {
            $simpan = Konsumen::create([
                'nama_lengkap' => $request->nama_lengkap,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'nomor_hp' => $request->nomor_hp,
                'email' => $request->email
            ]);

            if ($simpan) {
                $credential = $request->only('username','password');
                if (Auth::guard('konsumen')->attempt($credential)) {
                    Mail::to($request->email)->send(new RegistrasiConfirm($simpan->id_konsumen));
                    $request->session()->put('role', 'konsumen');
                    $request->session()->put('id', 'id_konsumen');
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
