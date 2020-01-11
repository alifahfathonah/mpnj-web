<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumen';
    protected $primaryKey = 'id_konsumen';
    protected $fillable = ['nama_lengkap','username','password','provinsi_id','city_id','alamat','kode_pos','email','nomor_hp','status'];
}
