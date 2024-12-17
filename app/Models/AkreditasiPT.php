<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\lembagaakreditasi;
use App\Models\PeringkatAkreditasi;
class AkreditasiPT extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_akreditasi', 'id_pts', 'id_lembaga_apt', 'no_sk_apt', 'tgl_sk_apt','tgl_akhir_apt','peringkat_apt', 'status_akreditasi'];
    protected $table = 'tbl_akreditasi_pt';
    protected $primaryKey = 'id_akreditasi';

    public $Sortable = [ 'id_akreditasi', 'id_pts', 'id_lembaga_apt', 'no_sk_apt', 'tgl_sk_apt','tgl_akhir_apt', 'peringkat_apt', 'status_akreditasi'];
    public $timestamps = false;

    public function lembagaakreditasi(){
        
        return $this->belongsTo(lembagaakreditasi::class, 'id_lembaga_apt', 'id_lembaga_apt');
    }
    public function peringkat(){
        
        return $this->belongsTo(PeringkatAkreditasi::class, 'peringkat_apt', 'id_peringkat');
    }

}