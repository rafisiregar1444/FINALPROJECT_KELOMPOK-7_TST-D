<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProdiPtNullable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_prodi_pt', function (Blueprint $table) {
            // Mengubah kolom yang ada menjadi nullable
            $table->string('kode_prodi')->nullable()->change();
            $table->string('nama_prodi')->nullable()->change();
            $table->string('program')->nullable()->change();
            $table->string('no_sk')->nullable()->change();
            $table->date('tgl_sk')->nullable()->change();
            $table->string('status_prodi')->nullable()->change();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
}
