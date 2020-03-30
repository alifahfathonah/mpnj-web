<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw', function (Blueprint $table) {
            $table->increments('id_withdraw');
            $table->integer('pelapak_id')->unsigned();
            $table->foreign('pelapak_id')->references('id_pelapak')->on('pelapak');
            $table->integer('nominal');
            $table->enum('status', ['pending', 'diterima', 'sukses'])->default('pending');
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
        Schema::dropIfExists('withdraw');
    }
}
