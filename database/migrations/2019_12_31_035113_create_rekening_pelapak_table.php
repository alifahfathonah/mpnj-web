<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningPelapakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening_pelapak', function (Blueprint $table) {
            $table->increments('id_rekening');
            $table->string('nama_bank', 50)->nullable();
            $table->char('nomor_rekening', 25)->nullable();
            $table->string('atas_nama', 100)->nullable();
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
        Schema::dropIfExists('rekening_pelapak');
    }
}
