<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsumen;
use App\Models\Alamat;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

class ApiKonsumenController extends Controller
{
    protected $client, $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = 'c506cdfc35a33e3d47fb068b799c0630';
    }

    public function simpan_alamat(request $request)
    {
        $alamat = new Alamat;
        $alamat->nama = $request->nama;
        $alamat->nomor_telepon = $request->nomor_telepon;
        $alamat->provinsi_id = $request->provinsi_id;
        $alamat->nama_provinsi = $request->nama_provinsi;
        $alamat->city_id = $request->city_id;
        $alamat->nama_kota = $request->nama_kota;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->kecamatan_id = 0;
        $alamat->alamat_lengkap = $request->alamat_lengkap;
        $alamat->user_id = $request->user_id;
        $alamat->user_type = $request->user_type == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak';
        if ($alamat->save()) {
            $res['pesan'] = "Sukses!";
            $res['data'] = [$alamat];
            $alamat_utama = Konsumen::where('alamat_utama', null)->first();
            if ($alamat_utama) {
                Konsumen::where('id_konsumen', $request->user_id)->update(['alamat_utama' => $alamat->id_alamat]);
                return response()->json($res);
            } else {
                return response()->json($res);
            }
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        }
    }


    public function update_alamat(Request $request, $alamat_id)
    {
        $alamat = Alamat::find($alamat_id);
        $alamat->nama = $request->nama;
        $alamat->nomor_telepon = $request->nomor_telepon;
        $alamat->provinsi_id = $request->provinsi_id;
        $alamat->nama_provinsi = $request->nama_provinsi;
        $alamat->city_id = $request->city_id;
        $alamat->nama_kota = $request->nama_kota;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->kecamatan_id = 0;
        $alamat->alamat_lengkap = $request->alamat_lengkap;
        $alamat->user_id = $request->user_id;
        $alamat->user_type = $request->user_type == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak';
        if ($alamat->save()) {
            $res['pesan'] = "Sukses!";
            $res['data'] = [$alamat];
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        }
    }


    public function show_alamat($alamat_id)
    {
        $alamat = Alamat::where('id_alamat', $alamat_id)->get();
        if (count($alamat) > 0) {
            $res['pesan'] = "Sukses!";
            $res['data'] = $alamat;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        }
    }

    public function update_alamat_utama(Request $request, $alamat_id)
    {
        $alamat = new Alamat;
        $alamat->user_id = $request->user_id;
        $konsumen = Konsumen::where('id_konsumen', $request->user_id)->update(['alamat_utama' => $alamat_id]);
        if ($konsumen) {
            $res['pesan'] = "Sukses Update Alamat Utama!";
            // Konsumen::where('id_konsumen', $request->user_id)->update(['alamat_utama' => $alamat_id]);
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal Update Alamat Utama!";
            return response()->json($res2);
        }
    }

    public function hapus_alamat($alamat_id)
    {
        $hapus_alamat = Alamat::find($alamat_id)->delete();
        if ($hapus_alamat) {
            $res['pesan'] = "Sukses!";
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            return response()->json($res2);
        }
    }

    public function profile($id_konsumen)
    {
        $konsumen = Konsumen::with('daftar_alamat')->where('id_konsumen', $id_konsumen)->first(
            ['id_konsumen', 'nama_lengkap', 'username', 'nomor_hp', 'email', 'status', 'alamat_utama', 'status', 'created_at', 'updated_at']
        );

        //        return $konsumen->daftar_alamat[0]['id_alamat'];
        foreach ($konsumen->daftar_alamat as $a) {
            if ($a['id_alamat'] == $konsumen['alamat_utama']) {
                $a['status'] = 'utama';
            } else {
                $a['status'] = 'bukan';
            }
        }

        return response()->json([
            'pesan' => 'Sukses!!',
            'data' => $konsumen
        ]);
    }

    public function cek_email($email)
    {
        $konsumen = Konsumen::where('email', $email)->first();
        if ($konsumen) {
            $res['pesan'] = "Sukses!";
            $hasil['id_konsumen'] = $konsumen->id_konsumen;
            $res['data'] = $hasil;
            return response()->json($res);
        } else {
            return response()->json(['pesan' => 'Login Salah Bro, Santuyy'], 401);
        }
    }

    public function lupa_password(Request $request, $kosumenId)
    {

        $request = Validator::make(Request::all(), [
            'password' => 'required',
        ]);

        $konsumen = Konsumen::find($kosumenId);
        $konsumen->password = Hash::make(Request::get('password'));

        if ($request->fails()) {
            $res['pesan'] = "Gagal";
            $res['response'] = $request->messages();

            return response()->json($res);
        } else {
            $konsumen->save();
            $res2['pesan'] = "Sukses!";
            $res2['data'] = ["Password Berhasil Diganti"];

            return response()->json($res2);
        }
    }
}
