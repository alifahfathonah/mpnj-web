<?php

namespace App;

use App\Models\Alamat;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'nomor_hp',
        'foto_profil',
        'email',
        'status_official',
        'role',
        'nama_toko',
        'alamat_toko',
        'foto_toko',
        'rating',
        'saldo',
        'status',
        'alamat_utama',
        'remember_token',
        'alamat_toko',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'user_id', 'id_user');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'user_id', 'id_user');
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'user_id', 'id_user');
    }

    public function alamat_fix()
    {
        return $this->hasOne(Alamat::class, 'id_alamat', 'alamat_utama');
    }

    public function daftar_alamat()
    {
        return $this->hasMany(Alamat::class, 'user_id', 'id_user');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'user_id', 'id_user');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
