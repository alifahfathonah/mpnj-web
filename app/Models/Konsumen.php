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
    protected $fillable = ['nama_lengkap','username','password','provinsi_id','city_id','alamat','kode_pos','email','nomor_hp','status'];
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
}
