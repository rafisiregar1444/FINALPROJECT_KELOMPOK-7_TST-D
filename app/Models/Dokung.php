<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DokumenB;


class Dokung extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_dok', 'jenis_dok', 'nama_dok', 'digunakan', 'status', 'tgl_dibuat'];
    protected $table = 'tbl_dokung';
    protected $primaryKey = 'id_dok';
    const CREATED_AT = 'tgl_dibuat'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'tgl_dibuat'; // Kolom untuk tindakan updated_at

    public $Sortable =  [ 'id_dok', 'jenis_dok', 'nama_dok', 'digunakan', 'status', 'tgl_dibuat'];
    public function dokumenB()
    {
        return $this->belongsTo(DokumenB::class, 'id_dok', 'id_cat');
    }
}