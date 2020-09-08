<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening_Admin extends Model
{
    protected $table = 'rekening_admin';
    protected $primaryKey = 'id_rekening_admin';
    protected $fillable = ['nomer_rekening', 'ib_bank', 'atas_nama_rekening'];
    public $timestamps = false;

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'id_bank', 'bank_id');
    }
}
