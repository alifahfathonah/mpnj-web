<?php

namespace App\Repositories;

use App\Models\Pelapak;

class PelapakRepository
{
    public function all()
    {
        return Pelapak::orderBy('id_pelapak')
        ->get()
        ->map(
            function ($pelapaks) {
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
