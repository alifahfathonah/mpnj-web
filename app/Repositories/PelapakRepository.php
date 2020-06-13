<?php

namespace App\Repositories;

use App\User;

class PelapakRepository
{
    public function all()
    {
        return User::orderBy('id_user')
            ->where('role', 'pelapak')
            ->get()
            ->map(
                function ($pelapaks) {
                    return [
                        'id_pelapak' => $pelapaks->id_user,
                        'username' => $pelapaks->username,
                        'status_official' => $pelapaks->status_official,
                        'nama_toko' => $pelapaks->nama_toko,
                        'alamat_toko' => $pelapaks->alamat_toko,
                        'provinsi_id' => $pelapaks->provinsi_id,
                        'city_id' => $pelapaks->city_id,
                        'alamat' => $pelapaks->alamat,
                        'kode_pos' => $pelapaks->kode_pos,
                        'nomor_hp' => $pelapaks->nomor_hp,
                        'email' => $pelapaks->email,
                        'rating' => $pelapaks->rating,
                        'saldo' => $pelapaks->saldo,
                        'status'=> $pelapaks->status,
                    ];
                }
            );
    }

    public function findById($id_pelapak)
    {
        return Pelapak::where('id_pelapak', $id_pelapak)
            ->get()
            ->map(
                function ($pelapaks)
                {
                    return [
                    'id_pelapak' => $pelapaks->id_pelapak,
                    'username' => $pelapaks->username,
                    'status_official' => $pelapaks->status_official,
                    'nama_toko' => $pelapaks->nama_toko,
                    'alamat_toko' => $pelapaks->alamat_toko,
                    'provinsi_id' => $pelapaks->provinsi_id,
                    'city_id' => $pelapaks->city_id,
                    'alamat' => $pelapaks->alamat,
                    'kode_pos' => $pelapaks->kode_pos,
                    'nomor_hp' => $pelapaks->nomor_hp,
                    'email' => $pelapaks->email,
                    'rating' => $pelapaks->rating,
                    'saldo' => $pelapaks->saldo,
                    'status'=> $pelapaks->status,
                ];
                }
            );
    }
}
