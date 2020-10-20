<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $table = 'kurirs';
    protected $primaryKey = 'id_kurir';
    protected $fillable = ['kurir'];
}
