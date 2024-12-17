<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lomba extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_lomba', 'nama_lomba', 'keterangan', 'jenis_lomba', 'status', 'tgl_dibuat'];
    protected $table = 'tbl_lomba';
    protected $primaryKey = 'id_lomba';
    const CREATED_AT = 'tgl_dibuat'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'tgl_dibuat'; // Kolom untuk tindakan updated_at

    public $Sortable =  [ 'id_lomba', 'nama_lomba', 'keterangan', 'jenis_lomba', 'status', 'tgl_dibuat'];

}