<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_Produk extends Model
{
    protected $table = 'kategori_produk';
    protected $primaryKey = 'id_kategori_produk';
    protected $fillable = ['nama_kategori'];

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'id_kategori_produk', 'id_kategori_produk');
    }


}

