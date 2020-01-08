<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KonfirmasiPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfirasi_pembayaran', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('kode_transaksi',50);
            $table->string('total_transfer',50);
            $table->integer('id_rekening');
            $table->string('nama_pengirim',50);
            $table->date('tanggal_transfer');
            $table->string('bukti_transfer',100);
            $table->dateTime('waktu_konfirmasi');
            

            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
