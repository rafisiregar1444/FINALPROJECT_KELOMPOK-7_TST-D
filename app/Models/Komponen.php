<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Komponen extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'id_beasiswa', 'nm_komponen', 'pagu_awal', 'status', 'tgl_dibuat'];
    protected $table = 'tbl_komponen';
    protected $primaryKey = 'id';
    const CREATED_AT = 'tgl_dibuat'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'tgl_dibuat'; // Kolom untuk tindakan updated_at
    public $Sortable =  [ 'id', 'id_beasiswa', 'nm_komponen', 'pagu_awal', 'status', 'tgl_dibuat'];

}