<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelapak extends Model
{
    protected $table = 'pelapak';
    protected $primaryKey = 'id_pelapak';
<<<<<<< HEAD
    protected $fillable = ['username', 'password', 'status_official', 'nama_toko', 'alamat_toko', 'provinsi_id', 'city_id', 'alamat', 'kode_pos', 'nomor_hp', 'email', 'rating', 'saldo', 'status'];


    public function produk()
    {
        return $this->belongsTo('App\Models\Pelapak', 'id_pelapak', 'id_pelapak');
    }

}
=======
    protected $fillable = ['nama_lengkap','username','password','provinsi_id','city_id','alamat','kode_pos','email','nomor_hp','status','nama_toko','alamat_toko','status_official'];
}
>>>>>>> d30a528be2c70dfccc9acc5f45664fca90be5577
