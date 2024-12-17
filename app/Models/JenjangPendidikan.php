<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    use HasFactory;

    protected $table = 'ref_jenjang_pendidikan';
    protected $primaryKey = 'id_jenjang';
    public $timestamps = false;

    
    protected $fillable = [
        'id_jenjang',
        'nama_jenjang',
        'sort_jenjang',
        'kode_jenjang'
    ];
}
