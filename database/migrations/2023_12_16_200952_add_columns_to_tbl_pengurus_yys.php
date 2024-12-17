<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTblPengurusYys extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tbl_pengurus_yys', function (Blueprint $table) {
            $table->string('statusp')->nullable(false); // Mengubah menjadi NOT NULL
            $table->timestamp('tgl_update')->nullable(false);
            $table->string('id_yys_pt', 16)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tbl_pengurus_yys', function (Blueprint $table) {
            $table->dropColumn('statusp');
            $table->dropColumn('tgl_update');
            $table->dropColumn('id_yys_pt');
        });
    }
};
