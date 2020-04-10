<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening_Pelapak extends Model
{
    protected $table = 'rekening_pelapak';
    protected $primaryKey = 'id_rekening';
    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
        'user_id'
    ];
    public $timestamps = false;
}
