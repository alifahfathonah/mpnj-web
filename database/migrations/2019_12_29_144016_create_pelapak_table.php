<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelapakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelapak', function (Blueprint $table) {
            $table->increments('id_pelapak');
            $table->string('username');
            $table->string('password');
            $table->enum('status_official', ['santri','official']);
            $table->string('nama_toko');
            $table->text('alamat_toko');
            $table->integer('provinsi_id');
            $table->integer('city_id');
            $table->text('alamat');
            $table->char('kode_pos', 5);
            $table->string('nomor_hp');
            $table->string('email');
            $table->string('rating');
            $table->integer('saldo');
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
        Schema::dropIfExists('pelapak');
    }
}
