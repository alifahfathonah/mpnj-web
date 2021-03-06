<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->bigIncrements('id_complain');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->integer('produk_id')->unsigned();
            $table->foreign('produk_id')->references('id_produk')->on('produk');
            $table->integer('konsumen_id')->unsigned();
            $table->foreign('konsumen_id')->references('id_user')->on('users');
            $table->integer('transaksi_id')->unsigned();
            $table->foreign('transaksi_id')->references('id_transaksi')->on('transaksi');
            $table->string('kode_invoice')->nullable();
            $table->enum('status', ['Butuh Direspon', 'Sudah Dibaca', 'Selesai'])->default('Butuh Direspon');
            $table->enum('komplain', ['Tidak Sesuai', 'Tidak Lengkap', 'Rusak'])->default('Tidak Sesuai');
            $table->text('deskripsi')->nullable();
            $table->string('foto_komplain')->nullable();
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
        Schema::dropIfExists('complains');
    }
}
