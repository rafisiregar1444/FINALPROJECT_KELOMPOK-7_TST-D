<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YayasanPT extends Model
{
    use HasFactory;

    protected $fillable = [ 'nama_yys_pt', 'jenis_yys', 'alamat_yys_pt', 'id_yys_pts','nama_pts' ];
    protected $table = 'tbl_yayasan_pts';
}