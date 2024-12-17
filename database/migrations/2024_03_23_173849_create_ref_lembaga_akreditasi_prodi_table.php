<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefLembagaAkreditasiProdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_lembaga_akreditasi_prodi', function (Blueprint $table) {
            $table->increments('id_lembaga_aps');
            $table->string('nama_lembaga', 150);
            $table->string('sort_lembaga', 15);
            $table->tinyInteger('status_lembaga');
        });

        // Insert initial data
        DB::table('ref_lembaga_akreditasi_prodi')->insert([
            ['nama_lembaga' => 'Badan Akreditasi Nasional', 'sort_lembaga' => 'BANPT', 'status_lembaga' => 1],
            ['nama_lembaga' => 'Lembaga Akreditasi Mandiri PT Kesehatan', 'sort_lembaga' => 'LAMPT-Kes', 'status_lembaga' => 1],
            ['nama_lembaga' => 'Lembaga Akreditasi Mandiri Sains Alam dan Ilmu Formal', 'sort_lembaga' => 'LAMSAMA', 'status_lembaga' => 1],
            ['nama_lembaga' => 'Lembaga Akreditasi Mandiri Program Studi Keteknikan', 'sort_lembaga' => 'LAMTEKNIK', 'status_lembaga' => 1],
            ['nama_lembaga' => 'Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi', 'sort_lembaga' => 'LAMEMBA', 'status_lembaga' => 1],
            ['nama_lembaga' => 'Lembaga Akreditasi Mandiri Informatika dan Komputer', 'sort_lembaga' => 'LAMINFOKOM', 'status_lembaga' => 1]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_lembaga_akreditasi_prodi');
    }
}
