<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsumen', function (Blueprint $table) {
            $table->increments('id_konsumen');
            $table->string('nama_lengkap');
            $table->string('username');
            $table->string('password');
            $table->integer('provinsi_id');
            $table->integer('city_id');
            $table->string('alamat');
            $table->char('kode_pos', 5);
            $table->char('nomor_hp', 12);
            $table->string('email');
            $table->enum('status', ['aktif','nonaktif']);
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
        Schema::dropIfExists('konsumen');
    }
}
