<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\lembagaakreditasiprodi;
use App\Models\PeringkatAkreditasi;
class AkreditasiPS extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_akreditasi', 'id_pts_pts', 'id_lembaga_aps', 'no_sk_aps', 'tgl_sk_aps','tgl_akhir_aps','peringkat_aps', 'status_akreditasi_aps'];
    protected $table = 'tbl_akreditasi_prodi';
    protected $primaryKey = 'id_akreditasi';

    public $Sortable = [ 'id_akreditasi', 'id_pts_pts', 'id_lembaga_aps', 'no_sk_aps', 'tgl_sk_aps','tgl_akhir_aps','peringkat_aps', 'status_akreditasi_aps'];
    public $timestamps = false;

    public function lembagaakreditasiprodi(){
        
        return $this->belongsTo(lembagaakreditasiprodi::class, 'id_lembaga_aps', 'id_lembaga_aps');
    }
    public function peringkat(){
        
        return $this->belongsTo(PeringkatAkreditasi::class, 'peringkat_aps', 'id_peringkat');
    }

}