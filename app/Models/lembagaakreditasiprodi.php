<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lembagaakreditasiprodi extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_lembaga_aps', 'nama_lembaga', 'sort_lembaga', 'status_lembaga'];
    protected $table = 'ref_lembaga_akreditasi_prodi';
    protected $primaryKey = 'id_lembaga_aps';

    public $Sortable = [ 'id_lembaga_aps', 'nama_lembaga', 'sort_lembaga', 'status_lembaga'];


}