<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $primaryKey = 'id_bank';
    protected $fillable = ['nama_bank', 'foto_bank'];
    public $timestamps = false;

    public function rekening_admin()
    {
        return $this->hasOne(Rekening_Admin::class, 'bank_id', 'id_bank');
    }
}
