<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktaYYS extends Model
{
    use HasFactory;

    protected $fillable = ['id_akta_yys', 'no_akta', 'tgl_akta', 'nm_notaris', 'kota_notaris', 'jns_akta', 'status_akta', 'id_yys_pt', 'tgl_update'];
    protected $table = 'tbl_akta_yys';
    protected $primaryKey = 'id_akta_yys';

    public $sortable = ['id_akta_yys', 'no_akta', 'tgl_akta', 'nm_notaris', 'kota_notaris', 'jns_akta', 'status_akta', 'id_yys_pt', 'tgl_update'];
    
    public function yayasanPT()
    {
        return $this->belongsTo(YayasanPT::class, 'id_yys_pt', 'id_yys_pt');
    }
    const CREATED_AT = 'tgl_update'; // Tentukan kolom untuk tindakan created_at
    const UPDATED_AT = 'tgl_update'; // Tentukan kolom untuk tindakan updated_at
}