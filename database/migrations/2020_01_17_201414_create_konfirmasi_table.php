<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfirmasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfirmasi', function (Blueprint $table) {
            $table->increments('id_konfirmasi');
            $table->string('kode_transaksi')->unique();
            $table->integer('total_transfer');
            $table->string('nama_pengirim');
            $table->dateTime('tanggal_transfer')->useCurrent();
            $table->string('bukti_transfer');
            $table->dateTime('waktu_konfirmasi')->nullable();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konfirmasi');
    }
}
