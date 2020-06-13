<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('id_keranjang');
            $table->integer('produk_id')->unsigned();
            $table->foreign('produk_id')->references('id_produk')->on('produk');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->enum('status', ['N', 'Y'])->default('N');
            $table->integer('jumlah');
            $table->integer('harga_jual');
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
        Schema::dropIfExists('keranjang');
    }
}
