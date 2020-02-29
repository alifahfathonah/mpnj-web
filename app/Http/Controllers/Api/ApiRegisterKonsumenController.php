<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class ApiRegisterKonsumenController extends Controller
{
    public function create(request $request)
    {
        $konsumen = new Konsumen;
        $konsumen->nama_lengkap = $request->nama_lengkap;
        $konsumen->username = $request->username;
        $konsumen->password = Hash::make($request->password);
        $konsumen->nomor_hp = $request->nomor_hp;
        $konsumen->email = $request->email;
        $konsumen->status = $request->status;

        if ($konsumen->save()) {
            $res['pesan'] = "Sukses!";
            $res['data'] = [$konsumen];

            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];

            return response()->json($res2);
        }
    }

    public function update(Request $request, $kosumenId)
    {
        $konsumen = Konsumen::find($kosumenId);
        $konsumen->nama_lengkap = $request->nama_lengkap;
        $konsumen->nomor_hp = $request->nomor_hp;
        $konsumen->email = $request->email;
        $konsumen->status = $request->status;

        if ($konsumen->save()) {
            $res['pesan'] = "Sukses!";
            $res['data'] = [$konsumen];
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];

            return response()->json($res2);
        }
    }
       public function upload(Request $request)
        {
            $user = Konsumen::where('id_konsumen', $request->id_konsumen)->first();
            if ($user) {
                    File::delete('assets/foto_profil_konsumen/' .$user->foto_profil);
                    $simpan = Konsumen::find($user->id_konsumen);
                    $file = $request->file('file');
                    $name = $this->acakhuruf(15) . '.' . $file->getClientOriginalExtension();
                    $file->move('assets/foto_profil_konsumen', $name);
                    $simpan->foto_profil = $name;
                    $simpan->save();
                    $res['pesan'] = "Sukses!";
                    $res['data'] = [$simpan];
                    return response()->json($res);
            } else {
                  $res2['pesan'] = "Gagal!";
            $res2['data'] = [];

            return response()->json($res2);
            }
        }
          public static function acakhuruf($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
