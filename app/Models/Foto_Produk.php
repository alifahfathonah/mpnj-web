<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto_Produk extends Model
{
    protected $table = 'foto_produk';
    protected $primaryKey = 'id_foto_produk';
    protected $fillable = ['foto_produk','produk_id'];
    public $timestamps = false;
}
