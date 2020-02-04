<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Konsumen;
use App\Models\Pelapak;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ProfileWebController extends Controller
{
    protected $client, $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('API_RAJAONGKIR');
    }
    public function index()
    {
        return view('web/web_profile');
    }

    public function ubah(Request $request, $role, $id)
    {
        $sessionId = Session::get('id');

        $data = [
          'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nomor_hp' => $request->no_hp
        ];

        $fix_role = $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak' ;
        $ubah = $fix_role::where($sessionId, $id)->update($data);

        return redirect(URL::to('profile'));
        if ($ubah) {
            return redirect(URL::to('profile'));
        }
    public function alamat()
    {
        $role = Session::get('role');
        $sessionId = Session::get('id');
        $user_id = Auth::guard($role)->user()->$sessionId;

        $data['alamat'] = Alamat::with('user')
                ->where('user_id', $user_id)
                ->where('user_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
                ->get();

        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['provinsi'] = json_decode($request, false);

        return view('web/web_profile', $data);
    }
    public function simpan_alamat(Request $request)
    {
        $role = Session::get('role');
        $sessionId = Session::get('id');
        $user_id = Auth::guard($role)->user()->$sessionId;

        $data = [
          'nama' => $request->nama,
          'nomor_telepon' => $request->nomor_telepon,
          'provinsi_id' => $request->provinsi,
          'nama_provinsi' => $request->nama_provinsi,
          'city_id' => $request->kota,
          'nama_kota' => $request->nama_kota,
          'kode_pos' => $request->kode_pos,
          'kecamatan_id' => 0,
          'alamat_lengkap' => $request->alamat_lengkap,
          'user_id' => $user_id,
          'user_type' => $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak'
        ];

        $simpan = Alamat::create($data);
        if ($simpan) {
            return redirect()->back();
        }
    }
}
