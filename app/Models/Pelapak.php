<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelapak extends Authenticatable
{
	use Notifiable;
	
	protected $guard = 'pelapak';
	
    protected $table = 'pelapak';
    protected $primaryKey = 'id_pelapak';
    protected $fillable = ['nama_lengkap','username','password','provinsi_id','city_id','alamat','kode_pos','email','nomor_hp','status','nama_toko','alamat_toko','status_official'];
	protected $hidden = ['password'];

    public function transaksi()
    {
        return $this->morphOne(Transaksi::class, 'pembeli');
    }

    public function keranjang()
    {
        return $this->morphOne(Keranjang::class, 'pembeli');
    }

    public function alamat()
    {
        return $this->morphOne(Alamat::class, 'user');
    }

    public function alamat_fix()
    {
        return $this->hasOne(Alamat::class, 'id_alamat', 'alamat_utama');
    }

    public function daftar_alamat()
    {
        return $this->morphMany(Alamat::class, 'user');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'pelapak_id', 'id_pelapak');
    }
}
