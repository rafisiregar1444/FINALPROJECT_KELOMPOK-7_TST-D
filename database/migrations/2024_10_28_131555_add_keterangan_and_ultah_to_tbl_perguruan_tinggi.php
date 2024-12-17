<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganAndUltahToTblPerguruanTinggi extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tbl_perguruan_tinggi', function (Blueprint $table) {
            $table->string(column: 'keterangan')->nullable();
            $table->date('ultah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tbl_perguruan_tinggi', function (Blueprint $table) {
            $table->dropColumn(['keterangan', 'ultah']);
        });
    }
}
