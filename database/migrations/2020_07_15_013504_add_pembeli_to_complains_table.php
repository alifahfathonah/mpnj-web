<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPembeliToComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complains', function (Blueprint $table) {
            $table->integer('konsumen_id')->unsigned();
            $table->foreign('konsumen_id')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complains', function (Blueprint $table) {
            //
        });
    }
}
