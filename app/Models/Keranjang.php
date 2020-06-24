<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $fillable = [
        'produk_id',
        'user_id',
        'jumlah',
        'harga_jual',
        'kurir',
        'service',
        'ongkir',
        'etd',
        'status'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    // public function konsumen()
    // {
    //     return $this->belongsTo(Konsumen::class, 'konsumen_id', 'id_konsumen');
    // }

    // public function pelapak()
    // {
    //     return $this->belongsTo(Pelapak::class, 'konsumen_id', 'id_pelapak');
    // }
}
