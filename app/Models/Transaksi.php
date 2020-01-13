<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['kode_transaksi','konsumen_id','waktu_transaksi','total_bayar'];

    public function transaksi_detail()
    {
        return $this->hasMany(Transaksi_Detail::class, 'transaksi_id', 'id_transaksi');
    }
}
