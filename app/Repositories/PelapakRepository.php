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

    public function cari($nama)
    {
        return Produk::orderBy('id_produk')
            ->with('foto_produk', 'user', 'kategori')
            ->where('nama_produk', 'like', '%'.$nama.'%')
            ->get()
            ->map(
                function ($produks) {
                    return [
                        'id_produk' => $produks->id_produk,
                        'nama_produk' => $produks->nama_produk,
                        'kategori' => [
                            'id_kategori' => $produks->kategori->id_kategori_produk,
                            'nama_kategori' => $produks->kategori->nama_kategori
                        ],
                        'satuan' => $produks->satuan,
                        'berat' => $produks->berat,
                        'harga_modal' => $produks->harga_modal,
                        'harga_jual' => $produks->harga_jual,
                        'diskon' => $produks->diskon,
                        'stok' => $produks->stok,
                        'keterangan' => $produks->keterangan,
                        'tipe_produk' => $produks->tipe_produk,
                        'wishlist' => $produks->wishlist,
                        'terjual' => $produks->terjual,
                        'foto' => $produks->foto_produk->map(function ($foto) {
                            return [
                                'id_foto_poroduk' => $foto->id_foto_produk,
                                'foto_produk' => $foto->foto_produk
                            ];
                        }),
                        'pelapak' => [
                            'id_pelapak' => $produks->user->id_pelapak,
                            'nama_toko' => $produks->user->nama_toko,
                            'foto_pelapak' => $produks->user->foto_profil,
                            'alamat' => $produks->user->alamat
                        ]
                    ];
                }
            );
    }
}
