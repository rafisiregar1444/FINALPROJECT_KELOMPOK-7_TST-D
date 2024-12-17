<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Komponen;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_beasiswa', 'jenis_beasiswa', 'keterangan', 'pt_penerima', 'status'];
    protected $table = 'tbl_beasiswa';
    protected $primaryKey = 'id_beasiswa';
    public $timestamps = false;

    public $Sortable =  [ 'id_beasiswa', 'jenis_beasiswa', 'keterangan', 'pt_penerima', 'status'];
    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'id_beasiswa', 'id_beasiswa');
    }
}