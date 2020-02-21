<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Konsumen extends Authenticatable
{
    use Notifiable;
    public $guard = 'konsumen';
    protected $table = 'konsumen';
    protected $primaryKey = 'id_konsumen';
    protected $fillable = ['nama_lengkap', 'username', 'password', 'email', 'nomor_hp', 'status'];
    protected $hidden = ['password','remember_token'];

    public function transaksi()
    {
        return $this->morphOne(Transaksi::class, 'pembeli');
    }

    public function keranjang()
    {
        return $this->morphOne(Keranjang::class, 'pembeli');
    }

    public function alamat_fix()
    {
        return $this->hasOne(Alamat::class, 'id_alamat', 'alamat_utama');
    }

    public function daftar_alamat()
    {
        return $this->morphMany(Alamat::class, 'user');
    }
}
