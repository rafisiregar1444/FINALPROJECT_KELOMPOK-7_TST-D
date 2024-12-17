<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAkreditasiPtNullable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_akreditasi_pt', function (Blueprint $table) {
            // Tambahkan kode berikut untuk mengubah kolom menjadi nullable
            $table->string('id_lembaga_apt')->nullable()->change();
            $table->string('no_sk_apt')->nullable()->change();
            $table->date('tgl_sk_apt')->nullable()->change();
            $table->date('tgl_akhir_apt')->nullable()->change();
            $table->string('peringkat_apt')->nullable()->change();
            $table->integer('status_akreditasi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
}
