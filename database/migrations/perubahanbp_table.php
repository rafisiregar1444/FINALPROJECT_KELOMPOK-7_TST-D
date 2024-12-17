<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYayasanPTTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $YayasanPT = 'tbl_yayasan_pts';

        if (!Schema::hasTable($YayasanPT)) {
            Schema::create($YayasanPT, function (Blueprint $table) {
                $table->id('id_yys_pt');
                $table->string('nama_yys_pt');
                $table->string('alamat_yys_pt')->unique();
                $table->string('kd_kl_pddikti')->nullable();
                $table->integer('jenis_yys')->nullable()->change();
                $table->timestamps('tgl_update')->nullable();
            });
        } else {
            Schema::table($YayasanPT, function (Blueprint $table) {
                $table->string('new_column')->nullable();
                // Add other columns or modify existing ones if needed
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $YayasanPT = 'tbl_yayasan_pts';

        Schema::table($YayasanPT, function (Blueprint $table) {
            $table->string('jenis_yys')->nullable()->change();
            // Drop other columns or modify existing ones if needed
        });

        Schema::dropIfExists($YayasanPT);
    }
}
