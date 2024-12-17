<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeringkatAkreditasi extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_peringkat', 'nm_peringkat', 'status_peringkat', 'tgl_create'];
    protected $table = 'ref_peringkat_akreditasi';
    protected $primaryKey = 'id_peringkat';

    public $Sortable = [ 'id_peringkat', 'nm_peringkat', 'status_peringkat', 'tgl_create'];
}