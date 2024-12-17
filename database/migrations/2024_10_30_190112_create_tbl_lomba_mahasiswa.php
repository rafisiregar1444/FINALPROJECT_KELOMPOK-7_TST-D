<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLombaMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lomba_mahasiswa', function (Blueprint $table) {
            $table->id('id_lomba_mahasiswa'); // Kolom ID utama dengan auto increment
            $table->unsignedBigInteger('id_userx'); // Kolom ID user untuk foreign key
            $table->unsignedBigInteger('id_lomba'); // Kolom ID lomba untuk foreign key
            $table->string('keterangan', 255)->nullable(); // Kolom untuk nama lomba
            $table->tinyInteger('status')->nullable(); // Kolom untuk status lomba dengan satu digit
            $table->date('tanggal_menang')->nullable(); // Kolom untuk tanggal menang
            $table->timestamp('tgl_dibuat')->nullable(); // Kolom untuk tanggal dibuat
            $table->string('voucher', 8)->nullable();
            // Tambahkan constraint foreign key
            $table->foreign('id_userx')->references('id')->on('user_lists')->onDelete('cascade');
            $table->foreign('id_lomba')->references('id')->on('tbl_lomba')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_lomba_mahasiswa', function (Blueprint $table) {
            // Drop foreign keys sebelum menghapus tabel
            $table->dropForeign(['id_userx']);
            $table->dropForeign(['id_lomba']);
        });
        Schema::dropIfExists('tbl_lomba_mahasiswa'); // Menghapus tabel jika migrasi di-rollback
    }
}
