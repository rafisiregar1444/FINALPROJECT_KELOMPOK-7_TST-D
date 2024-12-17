<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KotaPT;
use App\Models\YayasanPT;
use App\Models\AkreditasiPT;


class PT extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_pts', 'pass_key', 'kd_pts', 'nama_pts', 'nm_kota', 'status_pts','nm_singkat', 'alamat', 'no_telp', 'email', 'laman', 'sk_pendirian', 'tgl_sk', 'tgl_tutup', 'íd_stat_milik', 'id_bp_pts', 'id_bp_dikti', 'status_khusus', 'keterangan' , 'ultah'];
    protected $table = 'tbl_perguruan_tinggi';
    protected $primaryKey = 'id_pts';
    public $timestamps = false;
    public $sortable = [ 'id_pts', 'pass_key', 'kd_pts', 'nama_pts', 'nm_kota', 'status_pts','nm_singkat', 'alamat', 'no_telp', 'email', 'laman', 'sk_pendirian', 'tgl_sk', 'tgl_tutup', 'íd_stat_milik', 'id_bp_pts', 'id_bp_dikti', 'status_khusus', 'keterangan' , 'ultah'];

    // Di model PT
    public function yayasanPT()
    {
        return $this->hasOne(YayasanPT::class, 'id_bp_pts', 'id_yys_pt');
    }

    public function kota()
    {
        return $this->belongsTo(KotaPT::class, 'nm_kota', 'id_kota');
    }
    public function akreditasipt()
    {
        return $this->belongsTo(AkreditasiPT::class, 'id_pts', 'id_pts');
    }
}