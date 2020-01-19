<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
	protected $table = 'konfirmasi';
	protected $primaryKey = 'id_konfirmasi';
	protected $fillable = ['kode_transaksi','total_transfer','rekening_admin_id','nama_pengirim','tanggal_transfer','bukti_transfer','waktu_konfirmasi'];
	public $timestamps = false;
}
