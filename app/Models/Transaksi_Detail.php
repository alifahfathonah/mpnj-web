<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaksi_Detail extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id_transaksi_detail';
    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'user_id',
        'jumlah',
        'harga_jual',
        'diskon',
        'kurir',
        'service',
        'ongkir',
        'etd',
        'sub_total',
        'status_order',
        'resi',
        'from_city_id',
        'from'
    ];
	public $timestamps = true;

	public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,'transaksi_id', 'id_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user')->where('user.role', '=', 'pelapak');
    }
}
