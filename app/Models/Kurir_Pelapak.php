<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurir_Pelapak extends Model
{
    protected $table = 'kurir_pelapak';
    protected $primaryKey = 'id_kurir_pelapak';
    protected $fillable = ['user_id', 'kurir_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');
    }

    public function kurir()
    {
        return $this->hasOne(Kurir::class, 'id_kurir', 'kurir_id');
    }
}
