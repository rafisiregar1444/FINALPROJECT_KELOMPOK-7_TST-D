<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dokung;
use App\Models\Beasiswa;


class DokumenB extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'id_beasiswa', 'íd_cat', 'urutan', 'status', 'tgl_dibuat'];
    protected $table = 'tbl_dokumen';
    protected $primaryKey = 'id';
    const CREATED_AT = 'tgl_dibuat'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'tgl_dibuat'; // Kolom untuk tindakan updated_at

    public $Sortable =  [ 'id', 'id_beasiswa', 'id_cat', 'urutan', 'status', 'tgl_dibuat'];
    public function dokung()
    {
        return $this->belongsTo(Dokung::class, 'id_cat', 'id_dok');
    }
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'id_beasiswa', 'id_beasiswa');
    }
}