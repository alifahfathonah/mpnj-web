<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\RajaOngkirGateway;
use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;

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
        $foto = $request->file('foto_profil');

        if ($foto == null) {
            $data = [
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'nomor_hp' => $request->no_hp
            ];
        } else {
            $filename = $this->acakhuruf(15) . '.' . $foto->getClientOriginalExtension();
            $data = [
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'nomor_hp' => $request->no_hp,
                'foto_profil' => $filename
            ];
            $foto->move('assets/foto_profil_konsumen', $filename);
        }


        // $fix_role = $role == 'konsumen' ? 'App\User' : 'App\Models\Konsumen';
        // $init = $fix_role::where('id_user', $id);
        $d = User::where('id_user', $id)->first();
        $ubah = $d->update($data);

        if ($ubah) {
            if ($foto != null) {
                File::delete('assets/foto_profil_konsumen/' . $d->foto_profil);
            }
            return redirect(URL::to('profile'))->with('suksesUbahProfile', 'Data profil berhasil disimpan.');
        }
    }

    public static function acakhuruf($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function rekening()
    {
        return view('web/web_profile');
    }

    public function alamat(Request $request)
    {
        if ($request->ajax()) {
            $id_alamat = $request->id_alamat;
            $alamat = Alamat::where('id_alamat', $id_alamat)->first();
            return response()->json($alamat, 200);
        } else {
            $data['alamat'] = Alamat::with('user')
                ->where('user_id', Auth::id())
                ->get();
            return view('web/web_profile', $data);
        }
    }

    public function simpan_alamat(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'provinsi_id' => $request->provinsi,
            'nama_provinsi' => $request->nama_provinsi,
            'city_id' => $request->kota,
            'nama_kota' => $request->nama_kota,
            'kode_pos' => $request->kode_pos,
            'kecamatan_id' => $request->kecamatan,
            'nama_kecamatan' => $request->nama_kecamatan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'user_id' => Auth::id()
        ];

        if ($request->has('wilayah') AND $request->has('kamar')) {
            $data['wilayah'] = $request->wilayah;
            $data['kamar'] = $request->kamar;
            $data['santri'] = $request->santri;
        }

        $simpan = Alamat::create($data);
        if ($simpan) {
            return redirect()->back()->with('alert', 'Alamat berhasil disimpan.');
        }
    }

    public function ubah_alamat(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'provinsi_id' => $request->provinsi,
            'nama_provinsi' => $request->nama_provinsi,
            'city_id' => $request->kota,
            'nama_kota' => $request->nama_kota,
            'kode_pos' => $request->kode_pos,
            'kecamatan_id' => $request->kecamatan,
            'nama_kecamatan' => $request->nama_kecamatan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'user_id' => Auth::id()
        ];

        $ubah = Alamat::where('id_alamat', $request->edit_id_alamat)->update($data);
        if ($ubah) {
            return redirect()->back()->with('alert', 'Alamat berhasil diperbaharui.');
        }
    }

    public function ubah_alamat_santri(Request $request, $id)
    {
        $data = [
            'nama' => $request->nama,
            'wilayah' => $request->wilayah,
            'kamar' => $request->kamar,
            'user_id' => Auth::id()
        ];

        $ubah = Alamat::where('id_alamat', $id)->update($data);
        if ($ubah) {
            return redirect()->back()->with('alert', 'Alamat berhasil diperbaharui.');
        }
    }

    public function hapus_alamat($id)
    {
        $hapus = Alamat::where('id_alamat', $id)->delete();
        if ($hapus) {
            return redirect()->back();
        }
    }

    public function ubah_alamat_utama($id)
    {
        $ubah = User::where('id_user', Auth::id())->update(['alamat_utama' => $id]);
        if ($ubah) {
            return redirect()->back()->with('alert', 'Alamat berhasil diperbaharui.');
        }
    }

    public function gantipassword(Request $request, $id)
    {
        $passwordlama = $request->passwordlama;
        $passwordbaru = $request->passwordbaru;
        $hashlama = Auth::user()->password;
        $hashbaru = Hash::make($passwordbaru);


//        $fix_role = $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak';

        if (Hash::check($passwordlama, $hashlama)) {
            $ubah = User::where('id_user', $id)->update(['password' => $hashbaru]);
            if ($ubah) {
                return redirect()->back()->with('suksesGantiPassword', 'Password berhasil diganti.');
            }
        } else {
            return redirect()->back()->with('gagalGantiPassword', 'Gagal. Periksa Kembali Data Anda. Pastikan data yang anda masukkan sudah benar.');
        }
    }

}
