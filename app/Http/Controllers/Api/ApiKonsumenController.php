<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsumen;
use App\Models\Alamat;
use App\Models\Keranjang;
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
        $alamat = Alamat::create([
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'provinsi_id' => $request->provinsi_id,
            'nama_provinsi' => $request->nama_provinsi,
            'city_id' => $request->city_id,
            'nama_kota' => $request->nama_kota,
            'kecamatan_id' => $request->kecamatan_id,
            'nama_kecamatan' => $request->nama_kecamatan,
            'kode_pos' => $request->kode_pos,
            'alamat_lengkap' => $request->alamat_lengkap,
            'user_id' => $request->user_id
        ]);
        if ($alamat) {
            $res['pesan'] = "Sukses!";
            $res['data'] = [$alamat];
            $user = User::find($request->user_id);
            if ($user->alamat_utama == null) {
                $updateAlamatUtama = User::where('id_user', $request->user_id)->update(['alamat_utama' => $alamat->id_alamat]);
                if ($updateAlamatUtama) {
                    return response()->json($res);
                }
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
        $data = [
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'provinsi_id' => $request->provinsi_id,
            'nama_provinsi' => $request->nama_provinsi,
            'city_id' => $request->city_id,
            'nama_kota' => $request->nama_kota,
            'kecamatan_id' => $request->kecamatan_id,
            'nama_kecamatan' => $request->nama_kecamatan,
            'kode_pos' => $request->kode_pos,
            'alamat_lengkap' => $request->alamat_lengkap,
            'user_id' => $request->user_id
        ];
        $update = Alamat::where('id_alamat', $alamat_id)->update($data);
        if ($update) {
            $res['pesan'] = "Sukses!";
            $res['data'] = [$data];
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

    public function update_alamat_utama(Request $request, $id_user)
    {
        $data = [
            'alamat_utama' => $request->id_alamat,
        ];
        $user = User::where('id_user', $id_user)->update($data);
        $findKeranjang = Keranjang::with('user', 'produk')->where('user_id', $id_user)->update(['kurir' => NULL, 'service' => NULL, 'ongkir' => 0, 'etd' => NULL,]);
        if ($user) {
            return response()->json([
                'status' => 200,
                'pesan' => 'Sukses Update Alamat Utama!'
            ]);
        } else {
            return response()->json([
                'pesan' => 'Gagal Update Alamat Utama!'
            ]);
        }
    }

    public function hapus_alamat(Request $request, $alamat_id)
    {
        $id_user = $request->id_user;
        $find = User::with('alamat')->where('id_user', $id_user)->first();
        // $alamat = Alamat::where('id_alamat', $find->alamat_utama)->first();
        if ($find->alamat_utama == $alamat_id) {
            // $hapus_alamat = Alamat::find($alamat_id)->delete();
            return response()->json([
                'pesan' => 'Alamat Utama Tidak Dapat Dihapus'
            ]);
        } else {
            Alamat::find($alamat_id)->delete();
            return response()->json([
                'pesan' => 'Alamat Berhasil Dihapus'
            ]);
        }
    }

    public function profile($id_konsumen)
    {
        $konsumen = User::with('daftar_alamat')->where('id_user', $id_konsumen)->first(
            ['id_user', 'nama_lengkap', 'username', 'nomor_hp', 'foto_profil', 'email', 'status', 'alamat_utama', 'status', 'created_at', 'updated_at']
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
        $userEmail = User::whereEmail($email)->first();
        if ($userEmail) {
            //            $res['pesan'] = "Sukses!";
            //            $hasil['id_konsumen'] = $konsumen->id_konsumen;
            //            $res['data'] = $hasil;
            return response()->json([
                'pesan' => 'Sukses!',
                'data' => $userEmail
            ]);
        } else {
            return response()->json(['pesan' => 'Login Salah Bro, Santuyy'], 401);
        }
    }

    public function ganti_password(Request $request, $id_konsumen)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'cekpassword' => 'required',
        ]);
        $user = User::find($id_konsumen);
        $cekpassword = $request->cekpassword;
        $newpassword = $request->password;
        $hash = $user->password;

        if (Hash::check($cekpassword, $hash)) {
            $user->password = Hash::make($newpassword);
            $updatePassword = $user->save();
            if ($updatePassword) {
                return response()->json([
                    'status' => 200,
                    'pesan' => 'Berhasil Diganti'
                ]);
            }
        } else {
            $res2['pesan'] = "Gagal";
            return response()->json($res2);
        }
    }

    public function hapus_akun($id_konsumen)
    {
        $hapus_akun = Konsumen::find($id_konsumen)->delete();
        if ($hapus_akun) {
            $res['pesan'] = "Sukses!";
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            return response()->json($res2);
        }
    }
}
