<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening_admin', function (Blueprint $table) {
            $table->increments('id_rekening_admin');
            $table->string('nomor_rekening');
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id_bank')->on('bank')->onDelete('cascade');
            $table->string('atas_nama_rekening');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekening_admin');
    }
}
