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
        return $this->hasMany('App\Models\Produk', 'kategori_produk_id', 'id_kategori_produk');
    }


}

