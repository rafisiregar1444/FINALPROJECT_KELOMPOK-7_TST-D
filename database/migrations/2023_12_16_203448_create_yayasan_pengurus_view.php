<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
            CREATE VIEW v_pengurus_yayasan AS
            SELECT
                y.id_yys_pt,
                y.nama_yys_pt,
                y.jenis_yys,
                y.alamat_yys_pt,
                p.id_pengurus,
                p.id_akta_yys,
                p.namap,
                p.jabatanp,
                p.keterangan,
                p.statusp,
                p.tgl_update AS tgl_update,
                y.tgl_update AS yayasan_tgl_update
            FROM tbl_yayasan_pts y
            LEFT JOIN tbl_pengurus_yys p ON y.id_yys_pt = p.id_yys_pt
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_pengurus_yayasan');
    }
};
