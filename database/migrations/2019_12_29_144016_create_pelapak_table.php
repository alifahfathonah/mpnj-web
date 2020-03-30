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
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('status_official', ['santri','official'])->default('santri');
            $table->string('nama_toko')->unique();
            $table->string('foto_profil')->nullable();
            $table->string('foto_toko')->nullable();
//             $table->integer('provinsi_id');
//            $table->integer('city_id');
//            $table->text('alamat');
//            $table->char('kode_pos', 5);
            $table->string('nomor_hp')->unique();
            $table->string('email')->unique();
            $table->string('rating')->nullable();
            $table->integer('saldo')->default(0);
            $table->enum('status', ['aktif','nonaktif'])->default('aktif');
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
