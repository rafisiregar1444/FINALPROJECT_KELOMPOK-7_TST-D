<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLomba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lomba', function (Blueprint $table) {
            $table->id('id_lomba'); // Kolom ID dengan nama id_lomba
            $table->string('nama_lomba', 50); // Kolom untuk nama lomba
            $table->string('keterangan', 255); // Kolom untuk nama lomba
            $table->tinyInteger('jenis_lomba'); // Kolom untuk jenis lomba
            $table->tinyInteger('status'); // Kolom untuk status lomba dengan satu digit
            $table->timestamp('tgl_dibuat')->nullable(); // Kolom untuk tanggal dibuat
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_lomba'); // Menghapus tabel jika migrasi di-rollback
    }
}
