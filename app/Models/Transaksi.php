<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['kode_transaksi', 'pembeli_id', 'pembeli_type', 'waktu_transaksi', 'batas_transaksi', 'total_bayar'];
    public $timestamps = false;

    public function transaksi_detail()
    {
        return $this->hasMany(Transaksi_Detail::class, 'transaksi_id', 'id_transaksi');
    }

    //    public function konsumen()
    //    {
    //    	return $this->hasOne(Konsumen::class, 'id_konsumen', 'konsumen_id');
    //    }

    public function konfirmasi()
    {
        return $this->hasOne(Konfirmasi::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function pembeli()
    {
        return $this->morphTo();
    }
}
