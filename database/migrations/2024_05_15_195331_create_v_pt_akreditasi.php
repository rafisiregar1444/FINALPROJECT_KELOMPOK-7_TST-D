<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVPtAkreditasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Buat view v_pt_akreditasi
        DB::statement("
            CREATE VIEW v_pt_akreditasi AS
            SELECT 
                pt.id_pts, pt.pass_key, pt.kd_pts, pt.nama_pts, pt.nm_kota, pt.status_pts, pt.nm_singkat, pt.alamat, 
                pt.no_telp, pt.email, pt.laman, pt.sk_pendirian, pt.tgl_sk, pt.tgl_tutup, pt.id_stat_milik, 
                pt.id_bp_pts, pt.id_bp_dikti, pt.status_khusus, pt.keterangan,
                akreditasi.id_akreditasi, akreditasi.id_lembaga_apt, akreditasi.no_sk_apt, 
                akreditasi.tgl_sk_apt, akreditasi.tgl_akhir_apt, akreditasi.peringkat_apt, akreditasi.status_akreditasi
            FROM tbl_perguruan_tinggi AS pt
            LEFT JOIN tbl_akreditasi_pt AS akreditasi ON pt.id_pts = akreditasi.id_pts
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus view v_pt_akreditasi
        DB::statement("DROP VIEW IF EXISTS v_pt_akreditasi");
    }
}
