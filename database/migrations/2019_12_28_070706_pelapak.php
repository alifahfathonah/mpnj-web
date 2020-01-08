<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pelapak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelapak', function (Blueprint $table) {
            $table->Increments('id_pelapak');
            $table->char('nomor_registrasi',50);//char
            $table->string('username',50);
            $table->string('password',20);
            $table->enum('status_official',['santri', 'official']);//enum ,santri official
            $table->string('nama_toko',50);
            $table->text('alamat_toko');//text
            $table->text('kecamatan');//text
            $table->char('kodepos',7);//char7
            $table->text('provinsi');//text
            $table->text('kab_kota');//text
            $table->char('no_hp',15);//char15
            $table->string('email',50);
            $table->date('tanggal_gabung',);//datetime
            $table->date('tanggal_update',);//datetime 
            $table->enum('status_toko',['aktif','nonaktif']);//enum,aktif,nonaktif
            $table->string('rating',50);
            $table->integer('saldo');//int kurang panjang

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
