<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $fillable = ['produk_id','konsumen_id','jumlah','harga_jual'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'konsumen_id', 'id_konsumen');
    }
}
