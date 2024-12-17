<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiPT extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_prodi_pts', 'id_pts', 'kode_prodi', 'nama_prodi', 'program', 'no_sk', 'tgl_sk', 'status_prodi' ];
    protected $table = 'tbl_prodi_pt';
    protected $primaryKey = 'id_prodi_pts';
    public $timestamps = false;

    public function jenjang()
    {
        return $this->belongsTo(JenjangPendidikan::class, 'program', 'kode_jenjang');
    }
    public $Sortable = [ 'id_prodi_pts', 'id_pts', 'kode_prodi', 'nama_prodi', 'program', 'no_sk', 'tgl_sk', 'status_prodi' ];

}