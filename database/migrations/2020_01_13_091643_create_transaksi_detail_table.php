<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->increments('id_transaksi_detail');
            $table->integer('transaksi_id')->unsigned();
            $table->foreign('transaksi_id')->references('id_transaksi')->on('transaksi');
            $table->integer('produk_id')->unsigned();
            $table->foreign('produk_id')->references('id_produk')->on('produk');
            $table->integer('jumlah')->default(0);
            $table->integer('harga_jual')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('sub_total')->default(0);
            $table->enum('status_order', ['Menunggu Konfirmasi','Telah Dikonfirmasi','Dikemas','Dikirim','Telah Sampai', 'Dibatalkan'])->default('Menunggu Konfirmasi');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id_user')->on('users');
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
        Schema::dropIfExists('transaksi_detail');
    }
}
