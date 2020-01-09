<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelapak extends Model
{
    protected $table = 'pelapak';
    protected $primaryKey = 'id_pelapak';
    protected $fillable = ['username', 'password', 'status_official', 'nama_toko', 'alamat_toko', 'provinsi_id', 'city_id', 'alamat', 'kode_pos', 'nomor_hp', 'email', 'rating', 'saldo', 'staus', ];
}
