<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'nama_produk',
        'satuan',
        'berat',
        'harga_modal',
        'harga_jual',
        'diskon',
        'stok',
        'keterangan',
        'tipe_produk',
        'wishlist',
        'terjual',
        'user_id',
        'kategori_produk_id',
        'slug'
    ];

    public function foto_produk()
    {
        return $this->hasMany(Foto_Produk::class, 'produk_id', 'id_produk');
    }

    public function kategori()
    {
        return $this->hasOne(Kategori_Produk::class, 'id_kategori_produk', 'kategori_produk_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_user', 'user_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'produk_id', 'id_produk');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'produk_id', 'id_produk');
    }

    public function komplain()
    {
        return $this->hasMany(Complain::class, 'produk_id', 'id_produk');
    }
}
