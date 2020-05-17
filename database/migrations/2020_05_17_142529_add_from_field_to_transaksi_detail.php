<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromFieldToTransaksiDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_detail', function (Blueprint $table) {
            $table->integer('from_city_id')->nullable();
            $table->text('from')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_detail', function (Blueprint $table) {
            $table->dropColumn('from_city_id');
            $table->dropColumn('from');
        });
    }
}
