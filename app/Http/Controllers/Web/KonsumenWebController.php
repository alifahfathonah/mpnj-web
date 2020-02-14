<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KonsumenWebController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function simpan(Request $request)
    {
        $simpan = Konsumen::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email
        ]);

        if ($simpan) {
            return redirect('register');
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
