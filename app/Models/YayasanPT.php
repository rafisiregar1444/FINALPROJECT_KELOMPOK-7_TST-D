<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YayasanPT extends Model
{
    use HasFactory;

    protected $fillable = [ 'nama_yys_pt', 'jenis_yys', 'alamat_yys_pt', 'id_yys_pt','tgl_update','kd_kl_pddikti'];
    protected $table = 'tbl_yayasan_pts';
    protected $primaryKey = 'id_yys_pt';

    public $Sortable = ['nama_yys_pt', 'jenis_yys', 'alamat_yys_pt', 'id_yys_pt','tgl_update','kd_kl_pddikti'];

    const CREATED_AT = 'tgl_update'; // Tentukan kolom untuk tindakan created_at
    const UPDATED_AT = 'tgl_update'; // Tentukan kolom untuk tindakan updated_at

}