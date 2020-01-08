<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelapak extends Model
{
    protected $table = 'pelapak';
    protected $primaryKey = 'id_pelapak';
    protected $fillable = ['nama_lengkap','username','password','provinsi_id','city_id','alamat','kode_pos','email','nomor_hp','status','nama_toko','alamat_toko','status_official'];
}
