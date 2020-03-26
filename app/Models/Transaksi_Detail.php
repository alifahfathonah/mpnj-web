<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi_Detail extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id_transaksi_detail';
    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'pelapak_id',
        'jumlah',
        'harga_jual',
        'diskon',
        'kurir',
        'service',
        'ongkir',
        'etd',
        'sub_total',
        'status_order',
        'resi'
    ];
	public $timestamps = false;

	public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,'transaksi_id', 'id_transaksi');
    }

    public function pelapak()
    {
        return $this->belongsTo(Pelapak::class, 'pelapak_id', 'id_pelapak');
    }
}
