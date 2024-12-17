<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\YayasanPT;
use App\Models\AktaYYS;



class PengurusYYS extends Model
{
    use HasFactory;

    protected $fillable = ['id_pengurus', 'id_akta_yys', 'namap', 'jabatanp', 'keterangan', 'statusp', 'tgl_update', 'id_yys_pt']; // Attribut yang bisa diisi

    protected $table = 'tbl_pengurus_yys'; // Nama tabel yang terhubung dengan model
    protected $primaryKey = 'id_pengurus'; // Kolom kunci utama pada tabel
    public $sortable = ['id_pengurus', 'id_akta_yys', 'namap', 'jabatanp', 'keterangan', 'statusp', 'tgl_update', 'id_yys_pt']; // Kolom-kolom yang dapat diurutkan

    public function aktaYYS()
    {
        return $this->belongsTo(AktaYYS::class, 'id_akta_yys', 'id_akta_yys');
    }
    public function yayasanPT()
    {
        return $this->belongsTo(YayasanPT::class, 'id_yys_pt', 'id_yys_pt');
    }

    const CREATED_AT = 'tgl_update'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'tgl_update'; // Kolom untuk tindakan updated_at
}
