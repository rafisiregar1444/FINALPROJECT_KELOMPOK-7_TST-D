<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lembagaakreditasi extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_lembaga_apt', 'nama_lembaga', 'sort_lembaga', 'status_lembaga'];
    protected $table = 'ref_lembaga_akreditasi';
    protected $primaryKey = 'id_lembaga_apt';

    public $Sortable = [ 'id_lembaga_apt', 'nama_lembaga', 'sort_lembaga', 'status_lembaga'];


}