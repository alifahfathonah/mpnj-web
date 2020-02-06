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
            $table->integer('privinsi_id');
            $table->integer('city_id');
            $table->integer('kecamatan_id');
            $table->char('kode_pos');
            $table->text('alamat_lengkap');
            $table->integer('user_id');
            $table->string('user_type');
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
