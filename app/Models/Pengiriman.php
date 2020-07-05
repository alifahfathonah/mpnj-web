<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_invoice',
        'kurir',
        'service',
        'ongkir',
        'etd',
        'resi'
    ];

    public function transaksi_detail()
    {
        return $this->hasMany(Transaksi_Detail::class, 'kode_invoice', 'kode_invoice');
    }
}
