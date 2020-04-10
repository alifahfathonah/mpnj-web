<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat', function (Blueprint $table) {
            $table->increments('id_alamat');
            $table->string('nama');
            $table->char('nomor_telepon');
            $table->integer('priovinsi_id');
            $table->string('nama_provinsi');
            $table->integer('city_id');
            $table->string('nama_kota');
            $table->integer('kecamatan_id');
            $table->string('nama_kecamatan');
            $table->char('kode_pos');
            $table->text('alamat_lengkap');
            $table->enum('santri', ['N', 'Y'])->default('N');
            $table->string('wilayah')->nullable();
            $table->string('kamar')->nullable();
            $table->text('alamat_santri')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat');
    }
}
