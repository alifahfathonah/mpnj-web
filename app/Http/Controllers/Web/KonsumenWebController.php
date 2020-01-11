<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KonsumenWebController extends Controller
{
    protected $client, $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('API_RAJAONGKIR');
    }

    public function index()
    {
        $request = $this->client->get('https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['provinsi'] = json_decode($request, false);
        return view('auth/register', $data);
    }

    public function simpan(Request $request)
    {
        $simpan = Konsumen::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => $request->password,
            'provinsi_id' => $request->provinsi,
            'city_id' => $request->kota,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
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
