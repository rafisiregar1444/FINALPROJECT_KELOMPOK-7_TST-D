<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VAkreditasi extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_akreditasi', 'id_pts', 'no_sk_apt', 'tgl_sk_apt','tgl_akhir_apt','sort_lembaga', 'nm_peringkat', 'status_akreditasi'];
    protected $table = 'v_akreditasi';
    protected $primaryKey = 'id_akreditasi';

    public $Sortable = [ 'id_akreditasi', 'id_pts', 'no_sk_apt', 'tgl_sk_apt','tgl_akhir_apt','sort_lembaga', 'nm_peringkat', 'status_akreditasi'];
    public $timestamps = false;

    public function PT(){
        
        return $this->belongsTo(PT::class, 'id_pts', 'id_pts');
    }

}