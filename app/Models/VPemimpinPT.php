<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;

class VPemimpinPT extends Model
{
    use HasFactory;

    protected $table = 'v_pemimpin_pt';

    protected $fillable = [
        'id_pts',
        'pass_key',
        'kd_pts',
        'nama_pts',
        'nm_kota',
        'status_pts',
        'nm_singkat',
        'alamat',
        'no_telp',
        'email',
        'laman',
        'sk_pendirian',
        'tgl_sk',
        'tgl_tutup',
        'id_stat_milik',
        'id_bp_pts',
        'id_bp_dikti',
        'status_khusus',
        'id_pts2',
        'nama_pimpinan',
        'tgl_awal',
        'tgl_akhir',
        'id_jabatan_pim',
        'id_jab',
        'status_jab',
        'no_hp',
        'id_pimpinan',
        'link_dokumen',
        'id_jabatan',
        'nm_jabatan_pim'
    ];

    public $timestamps = false;

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan_pim', 'id_jabatan');
    }
}
