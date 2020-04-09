<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('nama_lengkap');
            $table->string('username')->unique();
            $table->string('password');
            $table->char('nomor_hp', 12)->nullable();
            $table->string('foto_profil', 20)->nullable();
            $table->string('email')->unique();
            $table->enum('status_official', ['santri','official'])->default('santri');
            $table->enum('role', ['konsumen','pelapak'])->default('konsumen');
            $table->string('nama_toko')->unique();
            $table->string('foto_toko')->nullable();
            $table->string('rating')->nullable();
            $table->integer('saldo')->default(0);
            $table->enum('status', ['aktif','nonaktif'])->default('aktif');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
