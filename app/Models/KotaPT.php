<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotaPT extends Model
{
    use HasFactory;

    protected $table = 'ref_kota';
    protected $primaryKey = 'id_kota';
    public $timestamps = false;

    
    protected $fillable = [
        'id_kota',
        'nama_kota',
    ];
}
