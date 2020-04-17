<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->string('kode_transaksi')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id_user')->on('users');
//            $table->foreign('konsumen_id')->references('id_konsumen')->on('konsumen');
            $table->dateTime('waktu_transaksi')->useCurrent();
            $table->integer('total_bayar');
            $table->enum('proses_pembayaran', ['belum', 'sudah', 'terima', 'tolak'])->default('belum');
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
        Schema::dropIfExists('transaksi');
    }
}
