<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\Konsumen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ApiRegisterKonsumenController extends Controller
{
    public function create(request $request)
    {
        $validator = Validator::make($request->all(), [
           'username' => 'required|unique:users',
            'nomor_hp' => 'required|unique:users',
            'email' => 'required|email|unique:users'
        ]);

        if ($validator->fails()) {
            $pesan = '';
            for ($i = 0; $i < count($validator->errors()->keys()); $i++) {
                $pesan .= $validator->errors()->keys()[$i] . ', ';
                }
            $pesan .= 'sudah digunakan';
            return response()->json([
                'pesan' => $pesan
            ], 200);
        }

        $register = User::create([
            'nama_lengkap' =>  $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'role' => 'konsumen'
        ]);

        if ($register) {
            $url = URL::temporarySignedRoute('verify', now()->addMinutes(30), ['id' => $register->id_user]);
            $kirimEmailRegistrasi = Mail::to($register->email)->send(new EmailVerification($register, $url));
            $res['pesan'] = "Sukses!";
            $res['data'] = User::orderby('created_at', 'desc')->first();

            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];

            return response()->json($res2);
        }
    }

    public function update(Request $request, $kosumenId)
    {
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email
        ];

        $update = User::where('id_user', $kosumenId)->update($data);
        if ($update) {
            $res['pesan'] = "Sukses!";
            $res['data'] = $data;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];

            return response()->json($res2);
        }
    }

    public function upload(Request $request)
    {
        $user = User::where('id_user', $request->id_konsumen)->first();
        $file = $request->file('file');
        $name = $this->acakhuruf(15) . '.' . $file->getClientOriginalExtension();

        if (is_null($user->foto_profil)) {
            $file->move('assets/foto_profil_konsumen', $name);
            $user->foto_profil = $name;
            $update = $user->save();
        } else {
            $hapusFoto = File::delete('assets/foto_profil_konsumen/' . $user->foto_profil);
            if ($hapusFoto) {
                $file->move('assets/foto_profil_konsumen', $name);
                $user->foto_profil = $name;
                $update = $user->save();
            }
        }

        if ($update) {
            $res['pesan'] = "Sukses!";
            $res['data'] = $user;
            return response()->json($res);
        } else {
            $res['pesan'] = "Gagal!";
            $res['data'] = [];
        }

        return response()->json($res);
    }

    public function acakhuruf($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
