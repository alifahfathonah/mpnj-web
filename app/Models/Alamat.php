<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';
    protected $primaryKey = 'id_alamat';
    protected $fillable = [
        'nama',
        'nomor_telepon',
        'provinsi_id',
        'city_id',
        'kecamatan_id',
        'nama_kecamatan',
        'kode_pos',
        'alamat_lengkap',
        'user_id',
        'nama_provinsi',
        'nama_kota',
        'alamat_santri',
        'santri',
        'wilayah',
        'kamar'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    function getAlamat()
    {
        return $this->attributes['nama'] . ', ' . $this->attributes['alamat_lengkap'].', '.$this->attributes['nama_kecamatan'].', '.$this->attributes['nama_kota'].', '.$this->attributes['nama_provinsi'].', '.$this->attributes['kode_pos'].', '.$this->attributes['nomor_telepon'];
    }
}
