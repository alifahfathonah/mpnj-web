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
            $table->integer('jumlah');
            $table->integer('harga_jual');
            $table->integer('diskon');
            $table->string('kurir');
            $table->string('service');
            $table->integer('ongkir');
            $table->string('etd');
            $table->integer('sub_total');
            $table->enum('status_order', ['pending','verifikasi','packing','dikirim','sukses']);
            // $table->timestamps();
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
