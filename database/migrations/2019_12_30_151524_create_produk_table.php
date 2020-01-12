<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->string('nama_produk')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('berat')->default(0);
            $table->integer('harga_modal')->default(0);
            $table->integer('harga_jual')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('stok')->default(0);
            $table->longText('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->enum('tipe_produk', ['single', 'varian'])->default('single');
            $table->integer('pelapak_id')->unsigned();
            // $table->foreign('pelapak_id')->references('id_pelapak')->on('pelapak');
            $table->integer('wishlist')->default(0);
            $table->integer('terjual')->default(0);
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
        Schema::dropIfExists('produk');
    }
}
