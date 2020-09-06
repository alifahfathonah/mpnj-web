<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $table = 'kurirs';
    protected $primaryKey = 'id_kurir';
    protected $fillable = ['user_id', 'kurir', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
