<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id_review';
    protected $fillable = ['produk_id', 'konsumen_id', 'review', 'bintang', 'foto_review'];


    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'konsumen_id', 'id_konsumen');
    }
}
