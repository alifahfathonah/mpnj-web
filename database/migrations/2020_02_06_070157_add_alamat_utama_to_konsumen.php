<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatUtamaToKonsumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('alamat_utama')->after('status')->unsigned();
            $table->foreign('alamat_utama')->references('id_alamat')->on('alamat');
            $table->integer('alamat_toko')->unsigned();
            $table->foreign('alamat_toko')->references('id_alamat')->on('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
