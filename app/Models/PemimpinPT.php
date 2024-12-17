<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;


class PemimpinPT extends Model
{
    use HasFactory;

    protected $table = 'tbl_pemimpin_pt';

    protected $fillable = [
        'id_pimpinan',
        'id_pts',
        'nama_pimpinan',
        'id_jabatan_pim',
        'tgl_awal',
        'tgl_akhir',
        'no_hp',
        'link_dokumen',
        'status_jab',
        'tgl_create'
    ];

    protected $primaryKey = 'id_pimpinan';

    public $timestamps = false;

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan_pim', 'id_jabatan');
    }

}
