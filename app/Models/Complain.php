<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $table = 'complains';
    protected $primaryKey = 'id_complain';
    protected $fillable = ['id_complain', 'user_id', 'produk_id', 'komplain', 'deskripsi', 'foto_komplain'];
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }
}
