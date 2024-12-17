<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_jabatan', 'nm_jabatan_pim', 'peruntukan', 'status_jab' ];
    protected $table = 'ref_jabatan';
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;

    public $Sortable =  ['id_jabatan', 'nm_jabatan_pim', 'peruntukan', 'status_jab' ];
}