<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $primaryKey = 'id_banners';
    protected $fillable = ['id_banner', 'nama_banner', 'foto_banner', 'status'];
}
