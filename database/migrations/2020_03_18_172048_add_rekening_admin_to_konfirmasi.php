<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRekeningAdminToKonfirmasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konfirmasi', function (Blueprint $table) {
            $table->integer('rekening_admin_id')->unsigned();
            $table->foreign('rekening_admin_id')->references('id_rekening_admin')->on('rekening_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(Blueprint $table)
    {
        $table->dropForeign('rekening_admin_id');
    }
}
